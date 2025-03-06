<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response as FacadesResponse;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class JwtVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return FacadesResponse::api(401, 'Error Auth', [
                    'message' => 'Token Invalid'
                ]);
            } else if ($e instanceof TokenExpiredException) {
                return FacadesResponse::api(401, 'Error Auth', [
                    'message' => 'Token Expired'
                ]);
            } else {
                return FacadesResponse::api(401, 'Error Auth', [
                    'message' => 'Token Not Found'
                ]);
            }
        }

        return $next($request);
    }
}
