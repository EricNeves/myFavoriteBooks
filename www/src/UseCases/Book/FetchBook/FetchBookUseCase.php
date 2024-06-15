<?php

namespace App\UseCases\Book\FetchBook;

use App\Repositories\IBookRepository;
use App\UseCases\Book\FetchBook\IFetchBookUseCase;
use App\Utils\IImageUtils;
use Exception;

class FetchBookUseCase implements IFetchBookUseCase
{
    public function __construct(private IImageUtils $image, private IBookRepository $bookRepository)
    {
    }

    public function execute(int | string $book_id, int | string $user_id): array
    {
        $book = $this->bookRepository->findByID($book_id, $user_id);

        if (!$book) {
            throw new Exception("Sorry, book not found.");
        }

        $book['image'] = $this->image->convertBinaryToBase64($book['image']);

        $fetchBookDTO = new FetchBookDTO(
            $book['id'],
            $book['title'],
            $book['author'],
            $book['image'],
            $book['user_id'],
        );

        return $fetchBookDTO->toArray();
    }
}
