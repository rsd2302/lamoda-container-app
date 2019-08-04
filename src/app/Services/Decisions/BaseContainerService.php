<?php

namespace App\Services\Decisions;

use  App\Services\BaseContainerService as BaseService;

abstract class BaseContainerService extends BaseService
{
	const DEFAULT_PRODUCTS_COUNT_FOR_SEARCH = 100;

	abstract public function getList(int $productsCountForSearch = self::DEFAULT_PRODUCTS_COUNT_FOR_SEARCH);

	/**
	 * Преобразование списка с выбранными контейнерами и товарами
	 *  в список со всей информацией о контейнере
	 * Внутри проставляет товарам которые нужно взять из контейнера определенный атрибут
	 *
	 * @param  array $foundContainers Массив "Контейнер-Продукты"
	 * @return array                  Список контейнеров
	 */
	protected function getContainersWithSelectedProducts($foundContainers)
	{
		$containers = [];
		$selectedProducts = [];
		$productsCount = 0;
		foreach ($foundContainers as $containerId => $productIds) {
            $container = $this->http->request('GET', sprintf('containers/%s', $containerId));
	            $container = json_decode($container->getBody());

            foreach ($container->products as $productOrderId => $product) {
            	$isSelected = in_array($product->id, $productIds) && ! in_array($product->id, $selectedProducts);
            	$isSelected && $selectedProducts[] = $product->id;
            	$productsCount += $isSelected ? 1 : 0;
            	$container->products[$productOrderId]->selected = $isSelected;
            }

        	$containers[] = $container;
		}

		return [
			'containers' => $containers,
			'productsCount' => $productsCount,
		];
	}

	/**
	 * Преобразовывает список "продукт-контейнер" в "контейнер-продукты"
	 *
	 * @param  array $productContainerList список "продукт-контейнер"
	 * @return array                       список "контейнер-продукты"
	 */
	protected function productsToContainers($productContainerList)
	{
        $result = [];

        foreach ((array)$productContainerList as $productId => $containerId) {
            if (! isset($result[$containerId])) {
                $result[$containerId] = [];
            }

            $result[$containerId][] = $productId;
        }

        return $result;
	}
}