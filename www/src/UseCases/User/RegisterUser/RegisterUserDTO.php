<?php

namespace App\UseCases\User\RegisterUser;

class RegisterUserDTO
{
    public function __construct(private string $username, private string $email, private string $password)
    {
        $this->username = $username;
        $this->email    = $email;
        $this->password = $password;
    }

    public function username(): string
    {
        return $this->username;
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
