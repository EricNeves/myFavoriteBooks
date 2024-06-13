<?php

namespace App\HttpInteractions\Implementations;

use App\HttpInteractions\IJWTInteraction;
use App\Http\JWT;

class JWTInteraction implements IJWTInteraction
{
    public function __construct(private JWT $jwt)
    {
    }

    public function generateJWT(array $data = []): string
    {
        return $this->jwt->generateJWT($data);
    }
}
