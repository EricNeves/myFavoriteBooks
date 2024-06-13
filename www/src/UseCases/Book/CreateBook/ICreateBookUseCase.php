<?php

namespace App\UseCases\Book\CreateBook;

use App\UseCases\Book\CreateBook\CreateBookDTO;

interface ICreateBookUseCase
{
    public function execute(CreateBookDTO $createBookDTO): mixed;
}
