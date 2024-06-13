<?php

return [
    'Intro\WelcomeMessage\HomeController'              => \App\UseCases\Intro\WelcomeMessage\WelcomeMessageFactory::class,
    'User\RegisterUser\RegisterUserController'         => \App\UseCases\User\RegisterUser\RegisterUserFactory::class,
    'User\AuthenticateUser\AuthenticateUserController' => \App\UseCases\User\AuthenticateUser\AuthenticateUserFactory::class,
    'User\FetchUser\FetchUserController'               => \App\UseCases\User\FetchUser\FetchUserFactory::class,
];
