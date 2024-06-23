<?php

namespace App\UseCases\Book\CreateBook;

class CreateBookDTO
{
    public function __construct(private string $title, private string $author, private int $rating, private string $image, private int | string $user_id)
    {
        $this->title   = $title;
        $this->author  = $author;
        $this->rating  = $rating;
        $this->image   = $image;
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

    public function user_id(): int | string
    {
        return $this->user_id;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
