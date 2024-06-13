<?php

namespace App\UseCases\User\EditUser;

use App\Repositories\IUserRepository;
use App\UseCases\User\EditUser\EditUserDTO;
use App\UseCases\User\EditUser\IEditUserUseCase;
use Exception;

class EditUserUseCase implements IEditUserUseCase
{
    public function __construct(private IUserRepository $userRepository)
    {
    }

    public function execute(EditUserDTO $editUserDTO, int | string $userId): array
    {
        $updateUser = $this->userRepository->update(['username' => $editUserDTO->username()], $userId);

        if (!$updateUser) {
            throw new Exception('Sorry, we could not update the user.');
        }

        $user = $this->userRepository->findById($userId);

        return $user;
    }
}
