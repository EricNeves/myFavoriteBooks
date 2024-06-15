<?php

namespace App\UseCases\Book\EditBook;

use App\UseCases\Book\EditBook\EditBookDTO;

interface IEditBookUseCase
{
    public function execute(EditBookDTO $editBookDTO): array;
}
