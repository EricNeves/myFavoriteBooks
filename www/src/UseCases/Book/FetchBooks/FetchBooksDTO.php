<?php

namespace App\UseCases\Book\FetchBooks;

use JsonSerializable;

class FetchBooksDTO implements JsonSerializable
{
    private int|string $id;
    private string $title;
    private string $author;
    private string $image;
    private int|string $user_id;

    public function __construct(int | string $id, string $title, string $author, string $image, int | string $user_id)
    {
        $this->id      = $id;
        $this->title   = $title;
        $this->author  = $author;
        $this->image   = $image;
        $this->user_id = $user_id;
    }

    public function id(): int | string
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

    public function user_id(): int | string
    {
        return $this->user_id;
    }

    public function jsonSerialize(): array
    {
        return [
            'id'      => $this->id,
            'title'   => $this->title,
            'author'  => $this->author,
            'image'   => $this->image,
            'user_id' => $this->user_id,
        ];
    }
}
