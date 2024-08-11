<?php

namespace App\External\Services\Converters;

use App\Domain\Services\XmlConverterService;

class RevendaMaisConverter
{
    public function convert($data)
    {
        $arr = (new XmlConverterService('estoque'))->convertToArray($data);

        $vehicles = $arr['veiculos']['veiculo'];

        return array_map(function ($vehicle) {
            return $this->toObject($vehicle);
        }, $vehicles);
    }

    protected function toObject($vehicle)
    {
        return [
            'id' => $vehicle['codigoVeiculo'],
            'make' => $vehicle['marca'],
            'model' => $vehicle['modelo'],
            'year' => $vehicle['ano'],
            'color' => $vehicle['cor'],
            'km' => $vehicle['quilometragem'],
            'fuel' => $vehicle['tipoCombustivel'] ?? null,
            'transmission' => $vehicle['cambio'],
            'doors' => $vehicle['portas'],
            'price' => $vehicle['precoVenda'],
            'optionals' => $vehicle['opcionais']['opcional'] ?? [],
        ];
    }
}