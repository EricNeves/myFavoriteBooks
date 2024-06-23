<?php

namespace App\UseCases\User\EditUser;

class EditUserDTO
{
    public function __construct(private string $username)
    {
        $this->username = $username;
    }

    public function username(): string
    {
        return $this->username;
    }
}
