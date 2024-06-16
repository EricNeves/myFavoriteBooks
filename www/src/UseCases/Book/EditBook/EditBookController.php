<?php

namespace App\UseCases\Book\EditBook;

use App\Http\Request;
use App\Http\Response;
use App\UseCases\Book\EditBook\IEditBookUseCase;

class EditBookController
{
    public function __construct(private IEditBookUseCase $editBookUseCase)
    {
    }

    public function handle(Request $request, Response $response, array $matches): Response
    {
        $body = $request->body();

        $request->validateField($body, 'title', 'string');
        $request->validateField($body, 'author', 'string');
        $request->validateField($body, 'rating', 'int');
        $request->validateField($body, 'base64_image');

        $editUserDTO = new EditBookDTO(
            $body['title'],
            $body['author'],
            $body['rating'],
            $body['base64_image'],
            $matches[0],
            $request->user()->id
        );

        return $response->json([
            "data" => $this->editBookUseCase->execute($editUserDTO),
        ]);
    }
}
