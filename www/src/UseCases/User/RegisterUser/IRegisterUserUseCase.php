<?php

namespace App\UseCases\User\RegisterUser;

use App\UseCases\User\RegisterUser\RegisterUserDTO;

interface IRegisterUserUseCase
{
    public function execute(RegisterUserDTO $registerUserDTO): string;
}
