<?php

namespace App\UseCases\Book\FetchBooks;

use App\Repositories\IBookRepository;
use App\UseCases\Book\FetchBooks\IFetchBooksUseCase;
use App\Utils\IImageUtils;

class FetchBooksUseCase implements IFetchBooksUseCase
{
    public function __construct(private IImageUtils $image, private IBookRepository $bookRepository)
    {
    }

    public function execute(int | string $user_id): array
    {
        $books = $this->bookRepository->all($user_id);

        $llBooks = [];

        foreach ($books as $book) {
            $book['image'] = $this->image->convertBinaryToBase64($book['image']);

            $llBooks[] = new FetchBooksDTO(
                $book['id'],
                $book['title'],
                $book['author'],
                $book['rating'],
                $book['image'],
                $book['user_id']
            );
        }

        return $llBooks;
    }
}
