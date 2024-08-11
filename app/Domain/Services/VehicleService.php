<?php

namespace App\Domain\Services;

use App\Domain\Models\Vehicle;
use App\Domain\Repository\VehicleRepository;
use App\External\Services\Converters\RevendaMaisConverter;
use App\External\Services\Converters\WebMotorsConverter;
use App\External\Services\RevendaMaisService;
use App\External\Services\WebMotorsService;

class VehicleService extends BaseService
{
    protected $repository = VehicleRepository::class;

    public function updateVehicles()
    {
        $revendaMais = $this->updateRevendaMais();
        $webMotors = $this->updateWebMotors();

        $found = array_merge($revendaMais, $webMotors);
        return collect($found)->map(function ($vehicle) {
            return new Vehicle($vehicle);
        });
    }

    protected function updateRevendaMais()
    {
        $revendaMais = (new RevendaMaisService)->getVehicles();
        
        $arr = (new RevendaMaisConverter)->convert($revendaMais);

        foreach ($arr as $vehicle) {
            $toAdd = array_filter($vehicle, function ($key) {
                return $key != 'optionals';
            }, ARRAY_FILTER_USE_KEY);
            $this->repository->updateOrCreate($toAdd);
            (new OptionalService)->updateOrCreateManyByVehicle($vehicle['optionals'], $vehicle['id']);
        }

        return $arr;
    }

    protected function updateWebMotors()
    {
        $webMotors = (new WebMotorsService)->getVehicles();
        
        $arr = (new WebMotorsConverter)->convert($webMotors);

        foreach ($arr as $vehicle) {
            $toAdd = array_filter($vehicle, function ($key) {
                return $key != 'optionals';
            }, ARRAY_FILTER_USE_KEY);
            $this->repository->updateOrCreate($toAdd);
            (new OptionalService)->updateOrCreateManyByVehicle($vehicle['optionals'], $vehicle['id']);
        }

        return $arr;
    }
    
}