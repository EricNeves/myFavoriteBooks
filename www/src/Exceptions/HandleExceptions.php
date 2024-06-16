<?php

namespace App\Exceptions;

use App\Http\Response;

class HandleExceptions
{
    public static function handle(\Throwable $exception)
    {
        $response = new Response();

        $errors_code = [
            '23505' => [
                "message" => "Sorry, email already exists",
                "status"  => 400,
            ],
            '7'     => [
                "message" => "Sorry, database connection failed",
                "status"  => 500,
            ],
            "401"   => [
                "message" => $exception->getMessage(),
                "status"  => 401,
            ],
            "23503" => [
                "message" => "Sorry, user not found",
                "status"  => 401,
            ],
            "22P02" => [
                "message" => "Sorry, invalid data type provided for field book id",
                "status"  => 400,
            ],
        ];

        if (array_key_exists($exception->getCode(), $errors_code)) {
            return $response->json([
                'error' => $errors_code[$exception->getCode()]['message'],
            ], $errors_code[$exception->getCode()]['status']);
        }

        return $response->json([
            'error' => $exception->getMessage(),
        ], 400);
    }
}
