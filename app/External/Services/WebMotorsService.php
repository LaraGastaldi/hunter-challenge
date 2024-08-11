<?php

namespace App\External\Services;

class WebMotorsService extends ApiBaseService
{
    protected string $endpointDomain = 'api/v1';

    public function __construct()
    {
        $this->baseUrl .= '/webmotors';
        $this->authorization = 'Bearer ' . env('WEBMOTORS_TOKEN');
        $this->contentType = 'application/xml';
    }

    public function getVehicles()
    {
        return $this->call('GET', 'estoque');
    }
}