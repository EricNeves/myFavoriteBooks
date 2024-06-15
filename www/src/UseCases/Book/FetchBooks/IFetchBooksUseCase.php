<?php

namespace App\UseCases\Book\FetchBooks;

interface IFetchBooksUseCase
{
    public function execute(int | string $user_id): array;
}
