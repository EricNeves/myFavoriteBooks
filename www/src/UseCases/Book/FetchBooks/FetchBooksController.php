<?php

namespace App\UseCases\Book\FetchBooks;

use App\Http\Request;
use App\Http\Response;
use App\UseCases\Book\FetchBooks\IFetchBooksUseCase;

class FetchBooksController
{
    public function __construct(private IFetchBooksUseCase $fetchBooksUseCase)
    {
    }

    public function handle(Request $request, Response $response): Response
    {
        $books = $this->fetchBooksUseCase->execute($request->user()->id);

        return $response->json([
            "data" => $books,
        ]);
    }
}
