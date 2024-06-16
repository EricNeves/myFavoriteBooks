<?php

namespace App\UseCases\Book\EditBook;

class EditBookDTO
{
    private string $title;
    private string $author;
    private int $rating;
    private string $image;
    private int|string $book_id;
    private int|string $user_id;

    public function __construct(string $title, string $author, int $rating, string $image, int | string $book_id, int | string $user_id)
    {
        $this->title   = $title;
        $this->author  = $author;
        $this->rating  = $rating;
        $this->image   = $image;
        $this->book_id = $book_id;
        $this->user_id = $user_id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function author(): string
    {
        return $this->author;
    }

    public function rating(): int
    {
        return $this->rating;
    }

    public function image(): string
    {
        return $this->image;
    }

    public function book_id(): int | string
    {
        return $this->book_id;
    }

    public function user_id(): int | string
    {
        return $this->user_id;
    }

    public function toArray(): array
    {
        return [
            'title'  => $this->title,
            'author' => $this->author,
            'rating' => $this->rating,
            'image'  => $this->image,
        ];
    }
}
