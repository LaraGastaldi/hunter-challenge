<?php

namespace App\External\Services\Converters;

class WebMotorsConverter
{
    public function convert($data)
    {
        $data = $data->json();
        return array_map(function ($vehicle) {
            return $this->toObject($vehicle);
        }, $data['veiculos']);
    }

    protected function toObject($vehicle)
    {
        return [
            'id' => $vehicle['id'],
            'make' => $vehicle['marca'],
            'model' => $vehicle['modelo'],
            'year' => $vehicle['ano'],
            'color' => $vehicle['cor'],
            'km' => $vehicle['km'],
            'fuel' => $vehicle['combustivel'] ?? null,
            'transmission' => $vehicle['cambio'],
            'doors' => $vehicle['portas'],
            'price' => $vehicle['preco'],
            'optionals' => $vehicle['opcionais'] ?? [],
        ];
    }
}