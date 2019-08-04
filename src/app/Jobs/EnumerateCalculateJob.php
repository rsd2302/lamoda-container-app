<?php

namespace App\Jobs;

use App\Services\Decisions\ContainerEnumerateService;

class EnumerateCalculateJob extends Job
{
    protected $uniqueProducts;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($uniqueProducts)
    {
        $this->uniqueProducts = $uniqueProducts;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $serviceUrl = env('CONTAINER_API_URL');

        $service = new ContainerEnumerateService($serviceUrl);
        $service->startCalculate();
        $service->getList($this->uniqueProducts);
        $service->endSuccessCalculate();
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(\Exception $exception)
    {
        app('log')->critical($exception->getMessage());

        $serviceUrl = env('CONTAINER_API_URL');

        $service = new ContainerEnumerateService($serviceUrl);
        $service->endFailedCalculate($exception->getMessage());
    }
}
