<?php

namespace App\UseCases\User\FetchUser;

class FetchUserDTO
{
    public function __construct(private int | string $id, private string $username, private string $email)
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
        return get_object_vars($this);
    }
}
