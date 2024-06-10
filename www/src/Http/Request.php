<?php

namespace App\Http;

use Exception;

class Request
{
    /**
     * @var array
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
     * Function to validate the request fields
     *
     * @param array $data ['field' => 'value']
     * @param string $fieldName ['field']
     * @param string $dataType 'string' || 'email' || 'string|email'
     * @throws Exception
     * @return void
     */
    public function validateField(array $data, string $fieldName, string $dataType = 'string'): void
    {
        if (!isset($data[$fieldName]) || empty(trim(trim($data[$fieldName])))) {
            throw new Exception("The field ($fieldName) is required");
        }

        $types = explode('|', $dataType);

        foreach ($types as $type) {
            if ($type === 'string' && !is_string($data[$fieldName])) {
                throw new Exception("The field ($fieldName) must be a string");
            }

            if ($type === 'email' && !filter_var($data[$fieldName], FILTER_VALIDATE_EMAIL)) {
                throw new Exception("The field ($fieldName) must be a valid email");
            }
        }
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
