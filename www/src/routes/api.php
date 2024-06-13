<?php

use App\Http\Router;

Router::get('/', 'Intro\WelcomeMessage\HomeController');
Router::post('/users/register', 'User\RegisterUser\RegisterUserController');
Router::post('/users/login', 'User\AuthenticateUser\AuthenticateUserController');
