<?php

namespace App\UseCases\Book\RemoveBook;

class RemoveBookDTO
{
    public function __construct(private int | string $book_id, private int | string $user_id)
    {
        $this->book_id = $book_id;
        $this->user_id = $user_id;
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
        return get_object_vars($this);
    }
}
