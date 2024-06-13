<?php

namespace App\UseCases\User\AuthenticateUser;

class AuthenticateUserDTO
{
    private string $email;
    private string $password;

    public function __construct(string $email, string $password)
    {
        $this->email    = $email;
        $this->password = $password;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }
}
