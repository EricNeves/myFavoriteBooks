<?php

use App\Http\Router;

Router::get('/', 'Intro\WelcomeMessage\HomeController');

Router::post('/users/register', 'User\RegisterUser\RegisterUserController');
Router::post('/users/login', 'User\AuthenticateUser\AuthenticateUserController');
Router::get('/users/fetch', 'User\FetchUser\FetchUserController')->middlewares('auth');
Router::put('/users/edit', 'User\EditUser\EditUserController')->middlewares('auth');

Router::post('/books/create', 'Book\CreateBook\CreateBookController')->middlewares('auth');
Router::get('/books/all', 'Book\FetchBooks\FetchBooksController')->middlewares('auth');
Router::get('/books/fetch/{id}', 'Book\FetchBook\FetchBookController')->middlewares('auth');
