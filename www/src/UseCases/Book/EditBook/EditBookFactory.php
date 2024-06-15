<?php

namespace App\UseCases\Book\EditBook;

use App\Infrastructure\Postgres;
use App\Providers\Implementations\BookPostgresProvider;
use App\Repositories\Implementations\BookRepository;
use App\UseCases\Book\EditBook\EditBookController;
use App\UseCases\Book\EditBook\EditBookUseCase;
use App\Utils\Implementations\ImageUtils;

class EditBookFactory
{
    public function generateInstance(array $databaseConfig): EditBookController
    {
        $postgres           = new Postgres();
        $postgresProvider   = new BookPostgresProvider($postgres::connect($databaseConfig));
        $bookRepository     = new BookRepository($postgresProvider);
        $imageUtils         = new ImageUtils();
        $ditBookUseCase     = new EditBookUseCase($imageUtils, $bookRepository);
        $editBookController = new EditBookController($ditBookUseCase);

        return $editBookController;
    }
}
