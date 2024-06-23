<?php

namespace App\Repositories;

interface IBookRepository
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
     * @param array $data = ['title' => '', 'author' => '', 'rating' => '', 'image' => '', 'user_id' => '']
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
    /**
     * Method to get a record by ID
     *
     * @param int|string $id
     * @param int|string $user_id
     * @return array|bool
     */
    public function findByID(int | string $id, int | string $user_id): array | bool;
    /**
     * Method to update a record
     *
     * @param array $data = ['id' => '', 'title' => '', 'author' => '', 'rating' => '', 'image' => '']
     * @param int|string $user_id
     * @return bool
     */
    public function update(array $data, int | string $user_id): bool;
    /**
     * Method to delete a record
     *
     * @param int|string $id
     * @param int|string $user_id
     * @return bool
     */
    public function delete(int | string $id, int | string $user_id): bool;
}
