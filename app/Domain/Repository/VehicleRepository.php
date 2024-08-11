<?php

namespace App\Domain\Repository;

use App\Domain\Models\Vehicle;

class VehicleRepository extends BaseRepository
{
    protected $model = Vehicle::class;
}