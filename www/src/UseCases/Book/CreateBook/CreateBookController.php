<?php

namespace App\UseCases\Book\CreateBook;

use App\Http\Request;
use App\Http\Response;
use App\UseCases\Book\CreateBook\CreateBookDTO;
use App\UseCases\Book\CreateBook\ICreateBookUseCase;

class CreateBookController
{
    public function __construct(private ICreateBookUseCase $createBookUseCase)
    {
    }

    public function handle(Request $request, Response $response): Response
    {
        $body = $request->body();

        $request->validateField($body, 'title', 'string|min:1|max:255');
        $request->validateField($body, 'author', 'string|min:1|max:255');
        $request->validateField($body, 'rating', 'number|min:1|max:5');
        $request->validateField($body, 'base64_image', 'string');

        $createBookDTO = new CreateBookDTO(
            $body['title'],
            $body['author'],
            $body['rating'],
            $body['base64_image'],
            $request->user()->id,
        );

        return $response->json([
            "data" => $this->createBookUseCase->execute($createBookDTO),
        ]);
    }
}
