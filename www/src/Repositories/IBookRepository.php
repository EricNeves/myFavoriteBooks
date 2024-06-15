<?php

namespace App\Repositories;

interface IBookRepository
{
    /**
     * Method to create a new record
     *
     * @param array $data
     * @return bool
     */
    public function save(array $data): bool;
    /**
     * Method to get all records
     *
     * @param int|string $user_id
     * @return array
     */
    public function all(int | string $user_id): array;
    public function findByID(int | string $id, int | string $user_id): array | bool;
}
