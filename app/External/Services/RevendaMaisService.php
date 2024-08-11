<?php

namespace App\External\Services;

class RevendaMaisService extends ApiBaseService
{
    protected string $endpointDomain = 'api';

    public function __construct()
    {
        $this->baseUrl .= '/revendamais';
        $this->authorization = 'Bearer ' . env('REVENDAMAIS_TOKEN');
        $this->contentType = 'application/xml';
    }

    public function getVehicles()
    {
        return $this->call('GET', 'estoque');
    }
}