<?php

namespace App\UseCases\Book\RemoveBook;

use App\Infrastructure\Postgres;
use App\Providers\Implementations\BookPostgresProvider;
use App\Repositories\Implementations\BookRepository;
use App\UseCases\Book\RemoveBook\RemoveBookController;
use App\UseCases\Book\RemoveBook\RemoveBookUseCase;

class RemoveBookFactory
{
    public function generateInstance(array $databaseConfig): RemoveBookController
    {
        $postgres             = new Postgres();
        $postgresProvider     = new BookPostgresProvider($postgres::connect($databaseConfig));
        $bookRepository       = new BookRepository($postgresProvider);
        $removeBookUseCase    = new RemoveBookUseCase($bookRepository);
        $removeBookController = new RemoveBookController($removeBookUseCase);

        return $removeBookController;
    }
}
