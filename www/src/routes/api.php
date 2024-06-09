<?php

use App\Http\Router;

Router::get('/', 'Intro\WelcomeMessage\HomeController');
