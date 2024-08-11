<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\ErrorHandler\Exception\FlattenException;

class Handler extends \Illuminate\Foundation\Exceptions\Handler
{
    public function render($request, \Throwable $e)
    {
        if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            return response()->json(['error' => 'Not Found'], 404);
        }

        if (gettype($e) == Exception::class) {
            $err = FlattenException::create($e);
        } else {
            $err = FlattenException::createFromThrowable($e);
        }

        if ($err->getStatusCode() == 401) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if ($err->getStatusCode() == 405) {
            return response()->json(['error' => 'Method Not Allowed'], 405);
        }

        /**
         * erro fictício para API inacessível, usado para simular um erro de serviço externo
         */
        if ($err->getStatusCode() == 503) {
            return response()->json(['error' => 'API not available'], 503);
        }

        return parent::render($request, $e);
    }
}