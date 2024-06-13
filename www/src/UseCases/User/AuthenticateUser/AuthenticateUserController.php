<?php

namespace App\UseCases\User\AuthenticateUser;

use App\Http\Request;
use App\Http\Response;
use App\UseCases\User\AuthenticateUser\AuthenticateUserDTO;
use App\UseCases\User\AuthenticateUser\IAuthenticateUserUseCase;

class AuthenticateUserController
{
    public function __construct(private IAuthenticateUserUseCase $authenticateUserUseCase)
    {
    }

    public function handle(Request $request, Response $response): Response
    {
        $body = $request->body();

        $request->validateField($body, 'email', 'email');
        $request->validateField($body, 'password', 'string');

        $fields = new AuthenticateUserDTO(
            $body['email'],
            $body['password']
        );

        return $response->json([
            "data" => $this->authenticateUserUseCase->excute($fields),
        ]);
    }
}
