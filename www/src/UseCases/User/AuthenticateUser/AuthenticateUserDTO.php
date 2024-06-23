<?php

namespace App\UseCases\User\AuthenticateUser;

class AuthenticateUserDTO
{
    public function __construct(private string $email, private string $password)
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
