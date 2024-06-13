<?php

namespace App\Middlewares;

use App\Http\JWT;
use App\Http\Request;
use App\Http\Response;

class EnsureAuthenticatedMiddleware
{
    public function handle(Request $request, Response $respose)
    {
        $jwt          = new JWT();
        $jwtValidated = $jwt->validateJWT($request->bearerToken());

        if (!$jwtValidated) {
            return $respose->json(['message' => 'Unauthorized'], 401);
        }

        $request->setUser($jwtValidated);
    }
}
