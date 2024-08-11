<?php

namespace App\Domain\Middlewares;

use Closure;

class RevendaMaisMiddleware
{
    /**
     * Middleware fictício para o app de Revenda Mais
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->header('Authorization')) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }

        if ($request->header('Authorization') !== 'Bearer ' . env('REVENDAMAIS_TOKEN')) {
            return response()->json([
                'error' => 'Unauthorized'
            ], 401);
        }

        return $next($request);
    }
}