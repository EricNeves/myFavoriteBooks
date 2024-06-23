<?php

namespace App\Providers;

interface IDatabaseProvider
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
     * Method to find a record by email
     *
     * @param string $email
     * @return array
     */
    public function findByEmail(string $email): array | bool;
    /**
     * Method to find a record by id
     *
     * @param int $id
     * @return array
     */
    public function findById(int | string $id, int | string $user_id = null): array | bool;
    /**
     * Method to fetch all records
     */
    public function fetchAll(int | string $user_id = null): array;
    /**
     * Method to update a record
     *
     * @param array $data
     * @param int $user_id
     * @return bool
     */
    public function update(array $data, int | string $user_id): bool;
    /**
     * Method to delete a record
     *
     * @param int $id
     * @param int $user_id
     * @return bool
     */
    public function delete(int | string $id, int | string $user_id = null): bool;
}
