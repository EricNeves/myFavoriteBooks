<?php

namespace App\Providers;

interface IDatabaseProvider
{
    /**
     * Method to create a new record
     *
     * @param array $data = ['title' => '', 'author' => '', 'image' => '', 'user_id' => '']
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
     * @param array $data = ['id' => '', 'title' => '', 'author' => '', 'image' => '']
     * @return bool
     */
    public function update(array $data, int | string $userId): bool;
}
