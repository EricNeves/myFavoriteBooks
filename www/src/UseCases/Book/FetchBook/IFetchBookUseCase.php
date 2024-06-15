<?php

namespace App\UseCases\Book\FetchBook;

interface IFetchBookUseCase
{
    public function execute(int | string $book_id, int | string $user_id): array;
}
