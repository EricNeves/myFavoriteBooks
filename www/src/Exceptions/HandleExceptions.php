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
        ];

        if (array_key_exists($exception->getCode(), $errors_code)) {
            return $response->json([
                'error' => $errors_code[$exception->getCode()]['message'],
            ], $errors_code[$exception->getCode()]['status']);
        }

        return $response->json([
            'error' => $exception->getTrace(),
        ], 400);
    }
}
