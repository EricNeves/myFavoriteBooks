<?php

namespace App\Utils\Implementations;

use App\Utils\IPasswordUtils;

class PasswordUtils implements IPasswordUtils
{
    public function generatePasswordHash(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}
