<?php

namespace App\Repositories;

interface IUserRepository
{
    /**
     * Create a new user.
     *
     * @param array $data
     * @return bool
     */
    public function save(array $data): bool;
}
