<?php

namespace App\Services\Decisions;

class ContainerEnumerateService extends BaseContainerService
{
	protected $containers;

	/**
	 * Получение списка контейнеров содержащих уникальные товары
	 *
	 * @param  int $productsCountForSearch Количество товаров для поиска
	 * @return array                       Список контейнеров
	 */
	public function getList(int $productsCountForSearch = self::DEFAULT_PRODUCTS_COUNT_FOR_SEARCH)
	{
		$this->clearDatabase();
		$this->generateUniqueContainers();
		$this->enumerateContainers($productsCountForSearch);

		$productContainerList = $this->getBestDecision();
		$foundContainers = $this->productsToContainers($productContainerList);

		return $this->getContainersWithSelectedProducts($foundContainers);
	}

	/**
	 * Очистка базы решений
	 *
	 * @return void
	 */
	protected function clearDatabase()
	{
		app('db')->table('enumerate-containers')->delete();
		app('db')->table('enumerate-decisions')->delete();
	}

	/**
	 * Получение всех доступных контейнеров
	 *
	 * @return void
	 */
	protected function generateUniqueContainers()
	{
		$containers = $this->getAllContainers();
		foreach ($containers as $container) {
			$productIds = array_map(function($item) { return $item->id; }, $container->products);
			$productIds = array_unique($productIds);
			$productIds = array_sort($productIds);

			$hash = md5(implode('_', $productIds));

			if (app('db')->table('enumerate-containers')->where('hash', $hash)->count()) {
				continue;
			}

			$document = [
				'id' => $container->id,
				'products' => $productIds,
				'count' => count($productIds),
				'hash' => $hash,
			];

			$container = app('db')->table('enumerate-containers')->insert($document);

			$this->removeSimilarContainers($productIds);
		}
	}

	/**
	 * Удаляет контейнеры, которые состоят только из нужных продуктов
	 * К примеру, если новый контейнер включает в себя продукты 1, 2, 3, 4
	 *  нужно удалить все котнейнеры которые состоят из продуктов 1, 2, 3 или 1, 2 или 1
	 *
	 * @param  array  $productIds Массив продуктов основного контейнера
	 * @return void
	 */
	protected function removeSimilarContainers(array $productIds)
	{
		$containers = app('db')->table('enumerate-containers')->where('count', '<', count($productIds))->get();
		foreach ($containers as $container) {
			if (array_intersect($container['products'], $productIds)) {
				app('db')->table('enumerate-containers')->where('id', $container->id)->delete();
			}
		}
	}

	/**
	 * Расчет всех возможных вариантов
	 *
	 * @return void
	 */
	protected function enumerateContainers(int $productsCountForSearch)
	{
		$this->containers = app('db')->table('enumerate-containers')->get();

		foreach ($this->containers as $id => $container) {
			$productsMap = $this->recursiveWalk($productsCountForSearch, [], $id);
		}
	}

	/**
	 * Рекурсивный обход контейнеров
	 *
	 * @param  int     $needleCount Необходимое количество уникальных товаров
	 * @param  array   $map         Карта найденых товаров
	 * @param  integer $orderId     ID контейнера дял рекурсии
	 * @return void
	 */
	protected function recursiveWalk(int $needleCount, $map = [], $orderId = 0)	{
		if (count($map) >= $needleCount || ! isset($this->containers[$orderId])) {
			$document = [
				'containers-count' => count(array_flip($map)),
				'products-count' => count($map),
				'map' => $map,
			];

			$container = app('db')->table('enumerate-decisions')->insert($document);
			return;
		}

		foreach ($this->containers as $container) {
			foreach ($container['products'] as $productId) {
				if (isset($map[$productId])) {
					continue;
				}
				$map[$productId] = $container['id'];
			}
			$this->recursiveWalk($needleCount, $map, ++$orderId);
		}
	}

	/**
	 * Получение лучшего решения
	 * Алгоритм ищет решение, в котором максимальное количество товароа
	 *  и минимальное количество контейнеров для вскрытия
	 *
	 * @return array Массив "Продукт-Контейнер"
	 */
	protected function getBestDecision()
	{
		$maxUniqueProducts = app('db')->table('enumerate-decisions')->max('products-count');
		$decision = app('db')->table('enumerate-decisions')
			->where('products-count', $maxUniqueProducts)
			->orderBy('count desc')
			->first();

		return $decision['map'];
	}
}