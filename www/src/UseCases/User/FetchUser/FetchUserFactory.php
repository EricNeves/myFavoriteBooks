<?php

namespace App\UseCases\User\FetchUser;

use App\Infrastructure\Postgres;
use App\Providers\Implementations\PostgresProvider;
use App\Repositories\Implementations\UserRepository;
use App\UseCases\User\FetchUser\FetchUserController;
use App\UseCases\User\FetchUser\FetchUserUseCase;

class FetchUserFactory
{
    public function generateInstance(array $databaseConfig): FetchUserController
    {
        $postgres            = new Postgres();
        $postgresProvider    = new PostgresProvider($postgres::connect($databaseConfig));
        $userRepository      = new UserRepository($postgresProvider);
        $fetchUserUseCase    = new FetchUserUseCase($userRepository);
        $fetchUserController = new FetchUserController($fetchUserUseCase);

        return $fetchUserController;
    }
}
