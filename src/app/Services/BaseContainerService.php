<?php

namespace App\Services;

use GuzzleHttp\Client;

abstract class BaseContainerService
{
	/**
	 * Http клиент для обращения к серверу
	 *
	 * @var Client
	 */
	protected $http;

	/**
	 * Конструктор
	 *
	 * @param string $baseUrl Базовый url для сервиса
	 */
	function __construct(string $baseUrl)
	{
		$this->http = new Client([
            'base_uri' => $baseUrl,
        ]);
	}

	/**
	 * Получение всех доступных контейнеров
	 *
	 * @return void
	 */
	public function getAllContainers()
	{
		$page = 1;

		$result = [];

        while (true) {
            $containers = $this->http->request('GET', 'containers', ['query' => ['page' => $page]]);
            $containers = json_decode($containers->getBody());

            if (! count($containers)) {
                break;
            }
            $result = array_merge($result, $containers);

            $page++;
        }

		return $result;
	}
}