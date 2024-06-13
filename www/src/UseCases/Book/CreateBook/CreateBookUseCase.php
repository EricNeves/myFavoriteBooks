<?php

namespace App\UseCases\Book\CreateBook;

use App\Repositories\IBookRepository;
use App\UseCases\Book\CreateBook\ICreateBookUseCase;
use App\Utils\IImageUtils;
use Exception;

class CreateBookUseCase implements ICreateBookUseCase
{
    public function __construct(private IImageUtils $image, private IBookRepository $bookRepository)
    {
    }

    public function execute(CreateBookDTO $createBookDTO): array
    {
        $imageBase64 = $this->image->removeImageDataPrefix($createBookDTO->image());

        if (!$this->image->validate($imageBase64)) {
            throw new Exception("Invalid image type. Please, use only PNG, JPEG or JPG.");
        }

        $binaryImage = $this->image->convertBase64ToBinary($imageBase64);

        $fields = [
            'user_id' => $createBookDTO->user_id(),
            'title'   => $createBookDTO->title(),
            'author'  => $createBookDTO->author(),
            'image'   => $binaryImage,
        ];

        $createBook = $this->bookRepository->save($fields);

        if (!$createBook) {
            throw new Exception("Sorry, we couldn't create the book. Please try again.");
        }

        return $createBookDTO->toArray();
    }
}
