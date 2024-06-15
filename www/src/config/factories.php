<?php

return [
    'Intro\WelcomeMessage\HomeController'              => \App\UseCases\Intro\WelcomeMessage\WelcomeMessageFactory::class,
    'User\RegisterUser\RegisterUserController'         => \App\UseCases\User\RegisterUser\RegisterUserFactory::class,
    'User\AuthenticateUser\AuthenticateUserController' => \App\UseCases\User\AuthenticateUser\AuthenticateUserFactory::class,
    'User\FetchUser\FetchUserController'               => \App\UseCases\User\FetchUser\FetchUserFactory::class,
    'User\EditUser\EditUserController'                 => \App\UseCases\User\EditUser\EditUserFactory::class,
    'Book\CreateBook\CreateBookController'             => \App\UseCases\Book\CreateBook\CreateBookFactory::class,
    'Book\FetchBooks\FetchBooksController'             => \App\UseCases\Book\FetchBooks\FetchBooksFactory::class,
    'Book\FetchBook\FetchBookController'               => \App\UseCases\Book\FetchBook\FetchBookFactory::class,
];
