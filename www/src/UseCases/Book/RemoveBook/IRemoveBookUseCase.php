<?php

namespace App\UseCases\Book\RemoveBook;

use App\UseCases\Book\RemoveBook\RemoveBookDTO;

interface IRemoveBookUseCase
{
    public function execute(RemoveBookDTO $removeBookDTO): array;
}
