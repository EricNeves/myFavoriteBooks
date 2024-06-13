<?php

namespace App\UseCases\User\EditUser;

use App\Infrastructure\Postgres;
use App\Providers\Implementations\PostgresProvider;
use App\Repositories\Implementations\UserRepository;
use App\UseCases\User\EditUser\EditUserController;
use App\UseCases\User\EditUser\EditUserUseCase;

class EditUserFactory
{
    public function generateInstance(array $databaseConfig): EditUserController
    {
        $postgres           = new Postgres();
        $postgresProvider   = new PostgresProvider($postgres::connect($databaseConfig));
        $userRepository     = new UserRepository($postgresProvider);
        $editUserUseCase    = new EditUserUseCase($userRepository);
        $editUserController = new EditUserController($editUserUseCase);

        return $editUserController;
    }
}
