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
}
