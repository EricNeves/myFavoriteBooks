<?php

namespace App\UseCases\Book\RemoveBook;

use App\Repositories\IBookRepository;
use Exception;

class RemoveBookUseCase implements IRemoveBookUseCase
{
    public function __construct(private IBookRepository $bookRepository)
    {
    }

    public function execute(RemoveBookDTO $removeBookDTO): array
    {
        $deleteBook = $this->bookRepository->delete($removeBookDTO->book_id(), $removeBookDTO->user_id());

        if (!$deleteBook) {
            throw new Exception("Sorry, we couldn't delete the book. Please, try again later.");
        }

        return $removeBookDTO->toArray();
    }
}
