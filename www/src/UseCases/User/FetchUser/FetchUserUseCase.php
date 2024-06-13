<?php

namespace App\UseCases\User\FetchUser;

use App\Repositories\IUserRepository;
use App\UseCases\User\FetchUser\FetchUserDTO;
use App\UseCases\User\FetchUser\IFetchUserUseCase;

class FetchUserUseCase implements IFetchUserUseCase
{
    public function __construct(private IUserRepository $userRepository)
    {
    }

    public function execute(int | string $userId): array
    {
        $user = $this->userRepository->findById($userId);

        if (!$user) {
            throw new \Exception('Sorry, user not found.');
        }

        $fetchUserDTO = new FetchUserDTO($user['id'], $user['username'], $user['email']);

        return $fetchUserDTO->toArray();
    }
}
