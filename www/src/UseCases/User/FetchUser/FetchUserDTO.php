<?php

namespace App\UseCases\User\FetchUser;

class FetchUserDTO
{
    private int|string $id;
    private string $username;
    private string $email;

    public function __construct(int | string $id, string $username, string $email)
    {
        $this->id       = $id;
        $this->username = $username;
        $this->email    = $email;
    }

    public function id()
    {
        return $this->id;
    }

    public function username()
    {
        return $this->username;
    }

    public function email()
    {
        return $this->email;
    }

    public function toArray(): array
    {
        return [
            'id'       => $this->id,
            'username' => $this->username,
            'email'    => $this->email,
        ];
    }
}
