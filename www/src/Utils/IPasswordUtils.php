<?php

namespace App\Utils;

interface IPasswordUtils
{
    /**
     * Method to generate a password hash
     *
     * @param string $password
     * @return string
     */
    public function generatePasswordHash(string $password): string;
    /**
     * Method to verify a password
     *
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public function verifyPassword(string $password, string $hash): bool;
}
