<?php

namespace App\UseCases\Book\RemoveBook;

use App\Http\Request;
use App\Http\Response;
use App\UseCases\Book\RemoveBook\IRemoveBookUseCase;

class RemoveBookController
{
    public function __construct(private IRemoveBookUseCase $removeBookUseCase)
    {
    }

    public function handle(Request $request, Response $response, array $matches): Response
    {
        $removeBookDTO = new RemoveBookDTO(
            $matches[0],
            $request->user()->id
        );

        return $response->json([
            "data" => $this->removeBookUseCase->execute($removeBookDTO),
        ]);
    }
}
