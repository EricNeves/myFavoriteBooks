<?php

namespace App\UseCases\User\AuthenticateUser;

use App\HttpInteractions\Implementations\JWTInteraction;
use App\Http\JWT;
use App\Infrastructure\Postgres;
use App\Providers\Implementations\UserPostgresProvider;
use App\Repositories\Implementations\UserRepository;
use App\UseCases\User\AuthenticateUser\AuthenticateUserUseCase;
use App\Utils\Implementations\PasswordUtils;

class AuthenticateUserFactory
{
    public function generateInstance(array $databaseConfig): AuthenticateUserController
    {
        $postgresProvider           = new UserPostgresProvider(Postgres::connect($databaseConfig));
        $userRepository             = new UserRepository($postgresProvider);
        $passwordUtils              = new PasswordUtils();
        $jwt                        = new JWT();
        $jwtInteraction             = new JWTInteraction($jwt);
        $authenticateUserUseCase    = new AuthenticateUserUseCase($jwtInteraction, $passwordUtils, $userRepository);
        $authenticateUserController = new AuthenticateUserController($authenticateUserUseCase);

        return $authenticateUserController;
    }
}
