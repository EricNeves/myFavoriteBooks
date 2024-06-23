<?php

namespace App\Http;

use Exception;
use stdClass;

class JWT
{
    public function generateJWT(array $data = []): string
    {
        $header  = json_encode(['alg' => 'HS256', 'typ' => 'JWT']);
        $payload = json_encode($data);

        $headerEncoded  = $this->base64url_encode($header);
        $payloadEncoded = $this->base64url_encode($payload);

        $signature = $this->signature($headerEncoded, $payloadEncoded);

        return "$headerEncoded.$payloadEncoded.$signature";
    }

    public function validateJWT(string $token): stdClass | bool
    {
        $parts = explode('.', $token);

        if (count($parts) !== 3) {
            return false;
        }

        [$headerEncoded, $payloadEncoded, $signature] = $parts;

        if ($this->signature($headerEncoded, $payloadEncoded) !== $signature) {
            return false;
        }

        $payload = $this->base64url_decode($payloadEncoded);

        return $payload;
    }

    private function signature(string $header, string $payload): string
    {
        if (!isset($_ENV['JWT_SECRET'])) {
            throw new Exception('JWT_SECRET not defined in env.');
        }

        $signature = hash_hmac("sha256", "$header.$payload", $_ENV['JWT_SECRET'], true);

        return $this->base64url_encode($signature);
    }

    private function base64url_encode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private function base64url_decode(string $data): stdClass
    {
        $padding = strlen($data) % 4;

        $padding !== 0 && $data .= str_repeat('=', 4 - $padding);

        $data = strtr($data, '-_', '+/');

        return json_decode(base64_decode($data));
    }
}
