<?php

namespace App\Repositories\Implementations;

use App\Providers\IUserPostgresProvider;
use App\Repositories\IUserRepository;

class UserRepository implements IUserRepository
{
    public function __construct(private IUserPostgresProvider $database)
    {
    }

    public function save(array $data): bool
    {
        return $this->database->create($data);
    }

    public function findByEmail(string $email): array | bool
    {
        return $this->database->findByEmail($email);
    }

    public function findById(int $id): array | bool
    {
        return $this->database->findById($id);
    }

    public function update(array $data, int | string $userId): bool
    {
        return $this->database->update($data, $userId);
    }
}
