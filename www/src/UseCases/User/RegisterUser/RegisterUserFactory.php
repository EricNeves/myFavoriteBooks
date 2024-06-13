<?php

namespace App\UseCases\User\RegisterUser;

use App\Infrastructure\Postgres;
use App\Providers\Implementations\PostgresProvider;
use App\Repositories\Implementations\UserRepository;
use App\Utils\Implementations\PasswordUtils;

class RegisterUserFactory
{
    public function generateInstance(array $databaseConfig): RegisterUserController
    {
        $postgresProvider       = new PostgresProvider(Postgres::connect($databaseConfig));
        $userRepository         = new UserRepository($postgresProvider);
        $passwordUtils          = new PasswordUtils();
        $registerUserUseCase    = new RegisterUserUseCase($passwordUtils, $userRepository);
        $registerUserController = new RegisterUserController($registerUserUseCase);

        return $registerUserController;
    }
}
