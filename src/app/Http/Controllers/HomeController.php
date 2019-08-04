<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContainerService;
use App\Services\Decisions\ContainerGreedyService;
use App\Services\Decisions\ContainerEnumerateService;
use App\Jobs\EnumerateCalculateJob;

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

    public function getDecisionsPage()
    {
        $serviceUrl = env('CONTAINER_API_URL');
        $service = new ContainerEnumerateService($serviceUrl);

        $defaultUniqueProducts = \App\Services\Decisions\ContainerEnumerateService::DEFAULT_PRODUCTS_COUNT_FOR_SEARCH;
        $calculateInfo = $service->getCalculateInfo();

        return view('decisions', compact('defaultUniqueProducts', 'calculateInfo'));
    }

    public function postDecisionsCalculate(Request $request)
    {
        $this->validate($request, [
            'unique-products-count' => 'integer|required',
        ]);

        $job = new EnumerateCalculateJob(
            $request->get('unique-products-count')
        );
        dispatch($job);

        return redirect('/decisions');
    }

    public function getDecisionsBest()
    {
        $serviceUrl = env('CONTAINER_API_URL');
        $service = new ContainerEnumerateService($serviceUrl);
        $searchInfo = $service->getBestDecisionContainers();

        return view('decision', $searchInfo);
        
    }

    public function getList(Request $request)
    {
        $serviceUrl = env('CONTAINER_API_URL');

        $service = new ContainerGreedyService($serviceUrl);
        $searchInfo = $service->getList();

        return view('decision', $searchInfo);
    }

    public function containers(Request $request)
    {
        $serviceUrl = env('CONTAINER_API_URL');

        $service = new ContainerService($serviceUrl);
        $containers = $service->getAllContainers();

        return view('containers', compact('containers'));
    }

    public function getContainersGenerate()
    {
        return view('containers-generate');
    }

    public function postContainersGenerate(Request $request)
    {
        $intValues = [
            'containers-count' => 'required|integer',
            'container-products-count' => 'required|integer',
            'unique-products-count' => 'required|integer',
        ];
        $keys = array_keys($intValues);

        $this->validate($request, $intValues);

        $serviceUrl = env('CONTAINER_API_URL');

        $service = new ContainerService($serviceUrl);
        $containers = $service->recreateRandomContainers(...array_values($request->only($keys)));

        return redirect('/containers');
    }
}
