<?php

namespace App\UseCases\User\FetchUser;

use App\Http\Request;
use App\Http\Response;
use App\UseCases\User\FetchUser\IFetchUserUseCase;

class FetchUserController
{
    public function __construct(private IFetchUserUseCase $fetchUserUseCase)
    {
    }

    public function handle(Request $request, Response $response): Response
    {
        return $response->json([
            "data" => $this->fetchUserUseCase->execute($request->user()->id),
        ]);
    }
}
