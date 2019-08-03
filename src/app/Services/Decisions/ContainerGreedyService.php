<?php

namespace App\Services\Decisions;

class ContainerGreedyService
{
	/**
	 * Получение списка контейнеров содержащих уникальные товары
	 *
	 * @param  int $productsCountForSearch Количество товаров для поиска
	 * @return array                       Список контейнеров
	 */
	public function getList(int $productsCountForSearch = self::DEFAULT_PRODUCTS_COUNT_FOR_SEARCH)
	{
		$productContainerList = $this->getProductsContainersList($productsCountForSearch);

		$foundContainers = $this->productsToContainers($productContainerList);

		return $this->getContainersWithSelectedProducts($foundContainers);
	}

	/**
	 * Получение списка выбранных продуктов и контейнера, из которого нужно его взять
	 *
	 * @param  int    $limit Количесство уникальных продуктов для поиска
	 * @return array         Список продуктов
	 */
	protected function getProductsContainersList(int $limit)
	{
		$result = [];

        $page = 1;

        // В цикле запрашиваем контейнеры, до нахождения нужного количества товаров
        while (true) {
            $containers = $this->http->request('GET', 'containers', ['query' => ['page' => $page]]);
            $containers = collect(json_decode($containers->getBody()));

            if (! $containers->count()) {
                break;
            }

            foreach ($containers as $container) {
            	// Составляем список продукт-контейнер
                $resultTmp = [];
                foreach ($container->products as $product) {
                    $resultTmp[$product->id] = $container->id;
                }

                /**
                 * Выбираем лучший механизм добавления новых записей к результату
                 * Есть два варианта:
                 *  * Вставка с перезаписью значений (array_merge)
                 *  * Вставка только новых значений (concat arrays)
                 * Могут быть ситуации, когда замена всех лучше (товары текущего контейнера могут заменить несколько уже выбранных контейнеров)
                 * А могут быть ситации, когда замена будет мешать (текущий контейнер будет забирать товары из уже выбранных контейнеров не забирая их)
                 */
                // Складываю все уникальные товары в массив
                $arrayMergeList = array_replace($result, $resultTmp);
                $concatList     = $result + $resultTmp;
                $arrayMergeListLength = count(array_unique($arrayMergeList));
                $concatListLength     = count(array_unique($concatList));

                $result = $arrayMergeListLength > $concatListLength
                	? $concatList
                	: $arrayMergeList;

	            if (count($result) >= $limit) {
	                break;
	            }
            }

            $result = array_slice($result, 0, $limit, true);

            if (count($result) == $limit) {
                break;
            }

            $page++;
        }

        return $result;
	}
}