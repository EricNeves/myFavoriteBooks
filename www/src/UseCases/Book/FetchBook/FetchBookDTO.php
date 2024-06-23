<?php

namespace App\UseCases\Book\FetchBook;

class FetchBookDTO
{
    public function __construct(
        private int | string $id,
        private string $title,
        private string $author,
        private int $rating,
        private string $image,
        private int | string $book_id
    ) {
        $this->id      = $id;
        $this->title   = $title;
        $this->author  = $author;
        $this->rating  = $rating;
        $this->image   = $image;
        $this->book_id = $book_id;
    }

    public function id()
    {
        return $this->id;
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

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
