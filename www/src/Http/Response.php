<?php

namespace App\Http;

class Response
{
    /**
     * Function to return a JSON response
     *
     * @param mixed $data
     * @param int $status
     * @return Response
     */
    public function json(mixed $data = [], int $status = 200): Response
    {
        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode($data, JSON_UNESCAPED_SLASHES);
        exit;
    }
}
