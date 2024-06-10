<?php

namespace App\Utils;

interface IGenerator
{
    /**
     * Method to generate a password hash
     *
     * @param string $password
     * @return string
     */
    public function generatePasswordHash(string $password): string;
}
