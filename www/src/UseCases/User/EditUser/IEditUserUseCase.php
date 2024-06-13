<?php

namespace App\UseCases\User\EditUser;

use App\UseCases\User\EditUser\EditUserDTO;

interface IEditUserUseCase
{
    public function execute(EditUserDTO $dto, int | string $userId): array;
}
