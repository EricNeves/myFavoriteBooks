<?php

namespace App\Providers;

interface IBookPostgresProvider
{
    /**
     * Capture the last inserted ID
     *
     * @return int|string
     */
    public function lastInsertId(): int | string;
    /**
     * Method to create a new record
     *
     * @param array
     * @return bool
     */
    public function create(array $data): bool;
    /**
     * Method to find a record by id
     *
     * @param int|string $id
     * @param int|string $user_id
     * @return array
     */
    public function findById(int | string $id, int | string $user_id): array | bool;
    /**
     * Method to fetch all records
     *
     * @param int | string $user_id
     * @return array
     */
    public function fetchAll(int | string $user_id): array;
    /**
     * Method to update a record
     *
     * @param array $data
     * @param int | string $user_id
     * @return bool
     */
    public function update(array $data, int | string $user_id): bool;
    /**
     * Method to delete a record
     *
     * @param int $id
     * @param int | string $user_id
     * @return bool
     */
    public function delete(int | string $id, int | string $user_id): bool;
}
