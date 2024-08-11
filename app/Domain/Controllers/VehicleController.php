<?php

namespace App\Domain\Controllers;
use App\Domain\Resources\VehicleResource;
use App\Domain\Services\VehicleService;

class VehicleController extends BaseController
{
    protected $resource = VehicleResource::class;
    /**
     * @var VehicleService
     */
    protected $service = VehicleService::class;

    protected function updateVehicles($request)
    {
        return $this->service->updateVehicles();
    }
}