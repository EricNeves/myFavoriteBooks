<?php

namespace App\HttpInteractions;

interface IJWTInteraction
{
    /**
     * Generate a JWT token.
     *
     * @param array $data
     * @return string
     */
    public function generateJWT(array $data = []): string;
}
