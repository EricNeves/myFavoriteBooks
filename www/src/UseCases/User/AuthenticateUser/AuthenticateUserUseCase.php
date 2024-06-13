<?php

namespace App\UseCases\User\AuthenticateUser;

use App\Exceptions\AuthorizationException;
use App\HttpInteractions\IJWTInteraction;
use App\Repositories\Implementations\UserRepository;
use App\UseCases\User\AuthenticateUser\AuthenticateUserDTO;
use App\UseCases\User\AuthenticateUser\IAuthenticateUserUseCase;
use App\Utils\IPasswordUtils;

class AuthenticateUserUseCase implements IAuthenticateUserUseCase
{
    public function __construct(private IJWTInteraction $jwt, private IPasswordUtils $passwordUtils, private UserRepository $userRepository)
    {
    }

    public function excute(AuthenticateUserDTO $authenticateUserDTO): string
    {
        $authenticateUser = $this->userRepository->findByEmail($authenticateUserDTO->email());

        if (!$authenticateUser) {
            throw new AuthorizationException("Sorry, email or password is incorrect.", 401);
        }

        $matchPassword = $this->passwordUtils->verifyPassword($authenticateUserDTO->password(), $authenticateUser['password']);

        if (!$matchPassword) {
            throw new AuthorizationException("Sorry, email or password is incorrect.", 401);
        }

        $data = [
            'id'       => $authenticateUser['id'],
            'username' => $authenticateUser['username'],
            'email'    => $authenticateUser['email'],
        ];

        return $this->jwt->generateJWT($data);
    }
}
