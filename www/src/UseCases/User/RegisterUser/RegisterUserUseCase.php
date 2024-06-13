<?php

namespace App\UseCases\User\RegisterUser;

use App\Repositories\IUserRepository;
use App\UseCases\User\RegisterUser\IRegisterUserUseCase;
use App\UseCases\User\RegisterUser\RegisterUserDTO;
use App\Utils\IPasswordUtils;
use Exception;

class RegisterUserUseCase implements IRegisterUserUseCase
{
    public function __construct(private IPasswordUtils $passwordUtils, private IUserRepository $userRepository)
    {
    }

    public function execute(RegisterUserDTO $registerUserDTO): string
    {
        $hashPassword = $this->passwordUtils->generatePasswordHash($registerUserDTO->password());

        $fields = [
            'username' => $registerUserDTO->username(),
            'email'    => $registerUserDTO->email(),
            'password' => $hashPassword,
        ];

        $user = $this->userRepository->save($fields);

        if (!$user) {
            throw new Exception("Sorry, we couldn't create your account. Try again later.");
        }

        return "User created successfully!";
    }
}
