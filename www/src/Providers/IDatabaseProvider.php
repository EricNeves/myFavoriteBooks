<?php

namespace App\Providers;

interface IDatabaseProvider
{
    /**
     * Method to create a new record
     *
     * @param array $data
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
}
