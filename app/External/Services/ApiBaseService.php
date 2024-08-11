<?php

namespace App\External\Services;

use App\Domain\Services\BaseConverterService;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

abstract class ApiBaseService
{
    /**
     * A URL base da API
     * 
     * O ideal é que essa propriedade seja pega de alguma configuração, mas para esse
     * projeto exemplo, pegaremos strings fixas nas classes filhas.
     * 
     * Exemplo: https://localhost
     * @var string $baseUrl
     */
    protected string $baseUrl = 'http://127.0.0.1';

    /**
     * O domínio do endpoint
     * 
     * Exemplo: api/v1
     * @var string $endpointDomain
     */
    protected string $endpointDomain;

    /**
     * O token de autorização
     * @var string
     */
    protected string $authorization = '';

    /**
     * O tipo de conteúdo
     * @var string
     */
    protected string $contentType = 'application/json';

    public function __construct()
    {
        $this->baseUrl = trim($this->baseUrl, '/');
        $this->endpointDomain = trim($this->endpointDomain, '/');
    }

    /**
     * Método que faz a requisição para a API
     * 
     * @param string $method
     * @param string $endpoint
     * @param array<string, mixed> $data
     * @param array<string, mixed> $headers
     * @return Response
     */
    protected function call(string $method, string $endpoint, array $data = [], array $headers = []): Response
    {
        $headers = array_merge([
            'Authorization' => $this->authorization,
            'Content-Type' => $this->contentType
        ], $headers);

        $response = Http::withHeaders($headers)->withoutVerifying()->timeout(5)->$method("{$this->baseUrl}/{$this->endpointDomain}/{$endpoint}", $data);
        
        /**
         * Aqui poderia ser retornado a requisição falhada para o service tratar, 
         * mas para esse exemplo, vamos abortar a requisição para cair no Handler.
         */
        if ($response->status() != 200 && $response->status() != 201) {
            abort(503);
        }
        return $response;
    }
}