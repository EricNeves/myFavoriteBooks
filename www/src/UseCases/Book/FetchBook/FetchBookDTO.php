<?php

namespace App\UseCases\Book\FetchBook;

class FetchBookDTO
{
    private int|string $id;
    private string $title;
    private string $author;
    private string $image;
    private int|string $book_id;

    public function __construct(int | string $id, string $title, string $author, string $image, int | string $book_id)
    {
        $this->id      = $id;
        $this->title   = $title;
        $this->author  = $author;
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
        return [
            'id'      => $this->id,
            'title'   => $this->title,
            'author'  => $this->author,
            'image'   => $this->image,
            'book_id' => $this->book_id,
        ];
    }
}
