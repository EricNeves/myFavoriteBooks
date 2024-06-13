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
    /**
     * Find a user by email to authenticate.
     *
     * @param array $data
     * @return array | null
     */
    public function findByEmail(string $email): array | bool;
    /**
     * Find a user by id.
     *
     * @param int $id
     * @return array | null
     */
    public function findById(int $id): array | bool;
    /**
     * Update a user by id.
     *
     * @param array $data
     * @return bool
     */
    public function update(array $data, int | string $userId): bool;
}
