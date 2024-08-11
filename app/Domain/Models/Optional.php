<?php

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class Optional extends Model
{
    protected $table = 'optionals';
    protected $fillable = ['name'];

    public function veicule()
    {
        return $this->belongsToMany(Vehicle::class);
    }
}