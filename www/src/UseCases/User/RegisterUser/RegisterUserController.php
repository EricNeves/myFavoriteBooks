<?php

namespace App\UseCases\User\RegisterUser;

use App\Http\Request;
use App\Http\Response;
use App\UseCases\User\RegisterUser\IRegisterUserUseCase;
use App\UseCases\User\RegisterUser\RegisterUserDTO;

class RegisterUserController
{
    public function __construct(private IRegisterUserUseCase $registerUserUseCase)
    {
    }

    public function handle(Request $request, Response $response): Response
    {
        $body = $request->body();

        $request->validateField($body, 'username', 'string');
        $request->validateField($body, 'email', 'email');
        $request->validateField($body, 'password', 'string');

        $fields = new RegisterUserDTO(
            $body['username'],
            $body['email'],
            $body['password']
        );

        return $response->json([
            "data" => $this->registerUserUseCase->execute($fields),
        ]);
    }
}
