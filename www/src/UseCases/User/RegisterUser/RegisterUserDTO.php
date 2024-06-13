<?php

namespace App\UseCases\User\RegisterUser;

class RegisterUserDTO
{
    public string $username;
    public string $email;
    public string $password;

    public function __construct(string $username, string $email, string $password)
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
