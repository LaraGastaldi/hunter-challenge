<?php

namespace App\Domain\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;

/**
 * Classe base do veiculo.
 */
class Vehicle extends Model
{
    use Timestamp;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'make',
        'model',
        'year',
        'version',
        'color',
        'km',
        'fuel',
        'doors',
        'transmission',
        'price'
    ];

    public function optionals()
    {
        return $this->hasMany(Optional::class);
    }
}

// <codigoVeiculo>12345</codigoVeiculo>
// <marca>Chevrolet</marca>
// <modelo>Onix</modelo>
// <ano>2024</ano>
// <versao>LT</versao>
// <cor>Branco</cor>
// <quilometragem>10000</quilometragem>
// <tipoCombustivel>Gasolina</tipoCombustivel>
// <cambio>Automatica</cambio>
// <portas>4</portas>
// <precoVenda>85000.00</precoVenda>
// <ultimaAtualizacao>12/06/2024 18:10</ultimaAtualizacao>