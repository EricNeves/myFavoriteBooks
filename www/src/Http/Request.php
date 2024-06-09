<?php

namespace App\Http;

class Request
{
    /**
     * @var array|null
     */
    private array $user = [];

    /**
     * Function to get the request method
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Function to get the request body
     *
     * @return array
     */
    public function body(): array
    {
        $method = $this->getMethod();

        $json = json_decode(file_get_contents('php://input'), true) ?? [];

        $data = match ($method) {
            'GET' => $_GET,
            'POST', 'PUT', 'DELETE' => $json,
            default => [],
        };

        return $data;
    }

    /**
     * Function to get the user
     */
    public function user()
    {
        return $this->user;
    }

    /**
     * Function to set the user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
}
