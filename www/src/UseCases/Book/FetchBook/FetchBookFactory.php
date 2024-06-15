<?php

namespace App\UseCases\Book\FetchBook;

use App\Infrastructure\Postgres;
use App\Providers\Implementations\BookPostgresProvider;
use App\Repositories\Implementations\BookRepository;
use App\UseCases\Book\FetchBook\FetchBookController;
use App\UseCases\Book\FetchBook\FetchBookUseCase;
use App\Utils\Implementations\ImageUtils;

class FetchBookFactory
{
    public function generateInstance(array $databaseConfig): FetchBookController
    {
        $postgres            = new Postgres();
        $postgresProvider    = new BookPostgresProvider($postgres::connect($databaseConfig));
        $bookRepository      = new BookRepository($postgresProvider);
        $imageUtils          = new ImageUtils();
        $fetchBookUseCase    = new FetchBookUseCase($imageUtils, $bookRepository);
        $fetchBookController = new FetchBookController($fetchBookUseCase);

        return $fetchBookController;
    }
}
