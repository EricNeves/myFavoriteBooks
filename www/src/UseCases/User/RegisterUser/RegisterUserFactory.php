<?php

namespace App\UseCases\User\RegisterUser;

use App\Infrastructure\Postgres;
use App\Providers\Implementations\PostgresProvider;
use App\Repositories\Implementations\UserRepository;
use App\Utils\Implementations\Generator;

class RegisterUserFactory
{
    public function generateInstance(array $databaseConfig): RegisterUserController
    {
        $postgresProvider       = new PostgresProvider(Postgres::connect($databaseConfig));
        $userRepository         = new UserRepository($postgresProvider);
        $generator              = new Generator();
        $registerUserUseCase    = new RegisterUserUseCase($generator, $userRepository);
        $registerUserController = new RegisterUserController($registerUserUseCase);

        return $registerUserController;
    }
}
