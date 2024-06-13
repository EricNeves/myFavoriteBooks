<?php

namespace App\Http;

class JWT
{
    public function generateJWT(array $data = [])
    {
        $header  = json_encode(['alg' => 'HS256', 'typ' => 'JWT']);
        $payload = json_encode($data);

        $headerEncoded  = $this->base64url_encode($header);
        $payloadEncoded = $this->base64url_encode($payload);

        $signature = $this->signature($headerEncoded, $payloadEncoded);

        return "$headerEncoded.$payloadEncoded.$signature";
    }

    protected function signature(string $header, string $payload): string
    {
        $signature = hash_hmac("sha256", "$header.$payload", $_ENV['JWT_SECRET'], true);

        return $this->base64url_encode($signature);
    }

    protected function base64url_encode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    protected function base64url_decode(string $data): string
    {
        $padding = strlen($data) % 4;

        $padding !== 0 && $data .= str_repeat('=', 4 - $padding);

        $data = strtr($data, '-_', '+/');

        return base64_decode($data);
    }
}
