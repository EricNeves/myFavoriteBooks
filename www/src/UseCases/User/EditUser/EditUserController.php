<?php

namespace App\UseCases\User\EditUser;

use App\Http\Request;
use App\Http\Response;
use App\UseCases\User\EditUser\EditUserDTO;
use App\UseCases\User\EditUser\IEditUserUseCase;

class EditUserController
{
    public function __construct(private IEditUserUseCase $useCase)
    {
    }

    public function handle(Request $request, Response $response): Response
    {
        $body = $request->body();

        $request->validateField($body, 'username', 'string');

        $editUserDTO = new EditUserDTO($body['username']);

        return $response->json([
            "data" => $this->useCase->execute($editUserDTO, $request->user()->id),
        ]);
    }
}
