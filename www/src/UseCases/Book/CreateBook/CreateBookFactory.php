<?php

namespace App\UseCases\Book\CreateBook;

use App\Infrastructure\Postgres;
use App\Providers\Implementations\BookPostgresProvider;
use App\Repositories\Implementations\BookRepository;
use App\UseCases\Book\CreateBook\CreateBookController;
use App\Utils\Implementations\ImageUtils;

class CreateBookFactory
{
    public function generateInstance(array $databaseConfig): CreateBookController
    {
        $postgres             = new Postgres();
        $postgresProvider     = new BookPostgresProvider($postgres::connect($databaseConfig));
        $bookRepository       = new BookRepository($postgresProvider);
        $imageUtils           = new ImageUtils();
        $createBookUseCase    = new CreateBookUseCase($imageUtils, $bookRepository);
        $createBookController = new CreateBookController($createBookUseCase);

        return $createBookController;
    }
}
