<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContainerService;
use App\Services\Decisions\ContainerGreedyService;
use App\Services\Decisions\ContainerEnumerateService;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function info()
    {
        return view('info');
    }

    public function getList(Request $request)
    {
        $this->validate($request, [
            'strategy' => 'in:greedy,enumerate',
        ]);

        $strategy = $request->get('strategy', 'enumerate');
        $serviceUrl = env('CONTAINER_API_URL');

        switch ($strategy) {
            case 'greedy':
                $service = new ContainerGreedyService($serviceUrl);
                $containers = $service->getList();
                break;
            case 'enumerate':
                $service = new ContainerEnumerateService($serviceUrl);
                $containers = $service->getList();
                break;
        }

        return view('decision', compact('containers'));
    }

    public function containers(Request $request)
    {
        $serviceUrl = env('CONTAINER_API_URL');

        $service = new ContainerService($serviceUrl);
        $containers = $service->getAllContainers();

        return view('containers', compact('containers'));
    }
}
