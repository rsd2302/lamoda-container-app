<?php

namespace App\Services;

class ContainerService extends BaseContainerService
{
	public function recreateRandomContainers(int $containersCount, int $contianersProductsCount, int $uniqueProductsCount)
	{
        $container = $this->http->request('POST', 'containers/drop');

        for ($i=1; $i <= $containersCount; $i++) { 
        	$products = [];

        	for ($j=1; $j <= $contianersProductsCount; $j++) { 
        		$productId = rand(1, $uniqueProductsCount);
        		$products[] = [
        			'id' => $productId,
        			'name' => sprintf('Product %s', $productId),
        		];
        	}

        	$container = [
        		'id' => $i,
        		'name' => sprintf('Container %s', $i),
        		'products' => $products,
        	];

	        $container = $this->http->request('POST', 'containers', [
	        	'json' => $container
	        ]);
        }
	}
}