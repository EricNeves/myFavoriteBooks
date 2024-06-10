<?php

namespace App\Repositories\Implementations;

use App\Providers\IDatabaseProvider;
use App\Repositories\IUserRepository;

class UserRepository implements IUserRepository
{
    public function __construct(private IDatabaseProvider $database)
    {
    }

    public function save(array $data): bool
    {
        return $this->database->create($data);
    }
}
