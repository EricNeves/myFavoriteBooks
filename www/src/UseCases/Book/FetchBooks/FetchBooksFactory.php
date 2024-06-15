<?php

namespace App\UseCases\Book\FetchBooks;

use App\Infrastructure\Postgres;
use App\Providers\Implementations\BookPostgresProvider;
use App\Repositories\Implementations\BookRepository;
use App\UseCases\Book\FetchBooks\FetchBooksController;
use App\Utils\Implementations\ImageUtils;

class FetchBooksFactory
{
    public function generateInstance(array $databaseConfig): FetchBooksController
    {
        $postgres             = new Postgres();
        $postgresProvider     = new BookPostgresProvider($postgres::connect($databaseConfig));
        $bookRepository       = new BookRepository($postgresProvider);
        $imageUtils           = new ImageUtils();
        $fetchBooksUseCase    = new FetchBooksUseCase($imageUtils, $bookRepository);
        $fetchBooksController = new FetchBooksController($fetchBooksUseCase);

        return $fetchBooksController;
    }
}
