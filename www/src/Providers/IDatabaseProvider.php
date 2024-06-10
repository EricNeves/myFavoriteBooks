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
}
