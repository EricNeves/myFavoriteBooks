<?php

namespace app\Utils\Implementations;

use App\Utils\IGenerator;

class Generator implements IGenerator
{
    public function generatePasswordHash(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}
