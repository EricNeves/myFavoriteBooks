<?php

namespace App\Repositories\Implementations;

use App\Providers\IDatabaseProvider;
use App\Repositories\IBookRepository;

class BookRepository implements IBookRepository
{
    public function __construct(private IDatabaseProvider $database)
    {
    }

    public function save(array $data): bool
    {
        return $this->database->create($data);
    }

    public function all(int | string $user_id): array
    {
        return $this->database->fetchAll($user_id);
    }

    public function findByID(int | string $id, int | string $user_id): array | bool
    {
        return $this->database->findById($id, $user_id);
    }

    public function update(array $data, int | string $user_id): bool
    {
        return $this->database->update($data, $user_id);
    }
}
