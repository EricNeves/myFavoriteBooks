<?php

namespace App\UseCases\User\AuthenticateUser;

use App\UseCases\User\AuthenticateUser\AuthenticateUserDTO;

interface IAuthenticateUserUseCase
{
    public function excute(AuthenticateUserDTO $authenticateUserDTO): string;
}
