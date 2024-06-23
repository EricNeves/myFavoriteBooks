<?php

namespace App\Http;

use App\Exceptions\AuthorizationException;
use Exception;
use stdClass;

class Request
{
    /**
     * @var stdClass
     */
    private stdClass $user;

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
     * Simple function to validate the request fields
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

            if ($type === 'number' && !is_numeric($data[$fieldName])) {
                throw new Exception("The field ($fieldName) must be a integer");
            }

            $minLengthType = explode(':', $type);
            $maxLengthType = explode(':', $type);

            if (count($minLengthType) === 2 && $minLengthType[0] === 'min' && !is_numeric($data[$fieldName]) && strlen($data[$fieldName]) < $minLengthType[1]) {
                throw new Exception("The field ($fieldName) must be at least {$minLengthType[1]} characters");
            }

            if (count($maxLengthType) === 2 && $maxLengthType[0] === 'max' && !is_numeric($data[$fieldName]) && strlen($data[$fieldName]) > $maxLengthType[1]) {
                throw new Exception("The field ($fieldName) must be at most {$maxLengthType[1]} characters");
            }

            if (count($minLengthType) === 2 && $minLengthType[0] === 'min' && is_numeric($data[$fieldName]) && $data[$fieldName] < $minLengthType[1]) {
                throw new Exception("The field ($fieldName) must be at least {$minLengthType[1]} length");
            }

            if (count($maxLengthType) === 2 && $maxLengthType[0] === 'max' && is_numeric($data[$fieldName]) && $data[$fieldName] > $maxLengthType[1]) {
                throw new Exception("The field ($fieldName) must be at most {$maxLengthType[1]} length");
            }
        }
    }

    /**
     * Function to get the bearer token
     *
     * @throws AuthorizationException
     * @return string
     */
    public function bearerToken(): string
    {
        $headers = getallheaders();

        if (!isset($headers['Authorization'])) {
            throw new AuthorizationException('Authorization header is required', 401);
        }

        $authorizationsPartials = explode(' ', $headers['Authorization']);

        if (count($authorizationsPartials) !== 2) {
            throw new AuthorizationException('Invalid authorization header, bearer is required', 401);
        }

        return $authorizationsPartials[1];
    }

    /**
     * Function to get the user
     */
    public function user(): stdClass | null
    {
        return $this->user;
    }

    /**
     * Function to set the user
     */
    public function setUser(stdClass $user): void
    {
        $this->user = $user;
    }
}
