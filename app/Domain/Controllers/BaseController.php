<?php

namespace App\Domain\Controllers;

use App\Domain\Services\BaseService;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Classe base do controlador.
 * Todos os métodos devem ser privados, para que o método mágico __call possa ser utilizado, evelopando a resposta.
 */
abstract class BaseController
{
    /**
     * O resource que será utilizado pelo controlador.
     * Essa propriedade deve ser setada na classe filha como ExemploResource::class.
     * @var string
     */
    protected string $resource;
    /**
     * O service que será utilizado pelo controlador.
     * Essa propriedade deve ser setada na classe filha como ExemploService::class.
     * @var string|BaseService
     */
    protected string|BaseService $service;

    public function __construct()
    {
        $this->service = new $this->service();
    }


    private function create(array $data)
    {
        return $this->resource::create($data);
    }

    /**
     * Todas as calls devem passar por esse método mágico
     * @return JsonResource $resource
     */
    public function __call($method, $args)
    {
        if (!($this->$method instanceof \Closure)) {
            throw new Exception('Método não encontrado.');
        }

        $response = $this->$method(...$args);

        if ($response instanceof Collection) {
            return $this->resource::collection($response);
        }

        return new $this->resource($response);
    }
}