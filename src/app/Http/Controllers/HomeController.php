<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContainerGreedyService;

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
            'strategy' => 'in:greedy',
        ]);

        $strategy = $request->get('strategy', 'greedy');
        $serviceUrl = env('CONTAINER_API_URL');

        switch ($strategy) {
            case 'greedy':
                $service = new ContainerGreedyService($serviceUrl);
                $containers = $service->getList();
                break;
        }

        return view('container-list', compact('containers'));
    }
}
