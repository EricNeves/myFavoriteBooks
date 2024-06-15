<?php

namespace App\UseCases\Book\FetchBook;

use App\Http\Request;
use App\Http\Response;
use App\UseCases\Book\FetchBook\IFetchBookUseCase;

class FetchBookController
{
    public function __construct(private IFetchBookUseCase $fetchBookUseCase)
    {
    }

    public function handle(Request $request, Response $response, array $matches): Response
    {
        return $response->json([
            "data" => $this->fetchBookUseCase->execute($matches[0], $request->user()->id),
        ]);
    }
}
