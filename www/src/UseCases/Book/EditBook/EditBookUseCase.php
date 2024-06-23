<?php

namespace App\UseCases\Book\EditBook;

use App\Repositories\IBookRepository;
use App\UseCases\Book\EditBook\EditBookDTO;
use App\UseCases\Book\EditBook\IEditBookUseCase;
use App\Utils\IImageUtils;
use Exception;

class EditBookUseCase implements IEditBookUseCase
{
    public function __construct(private IImageUtils $image, private IBookRepository $bookRepository)
    {
    }

    public function execute(EditBookDTO $editBookDTO): array
    {
        $image = $this->image->removeImageDataPrefix($editBookDTO->image());

        $validateImage = $this->image->validate($image);

        if (!$validateImage) {
            throw new Exception("Invalid image type. Please, use only PNG, JPEG or JPG.");
        }

        $fields = [
            'id'     => $editBookDTO->book_id(),
            'title'  => $editBookDTO->title(),
            'author' => $editBookDTO->author(),
            'rating' => $editBookDTO->rating(),
            'image'  => $this->image->convertBase64ToBinary($image),
        ];

        $updateBook = $this->bookRepository->update($fields, $editBookDTO->user_id());

        if (!$updateBook) {
            throw new Exception("Sorry, we couldn't update the book. Please, try again later.");
        }

        return $editBookDTO->toArray();
    }
}
