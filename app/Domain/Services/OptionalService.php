<?php

namespace App\Domain\Services;

use App\Domain\Models\Optional;

class OptionalService extends BaseService
{
    protected $repository = Optional::class;

    public function updateOrCreateManyByVehicle($optionals, $vehicleId)
    {
        $vehicle = (new VehicleService)->find($vehicleId);

        $vehicle->optionals()->delete();

        foreach ($optionals as $optional) {
            $vehicle->optionals()->create(['name' => $optional, 'vehicle_id' => $vehicleId]);
        }
    }
}