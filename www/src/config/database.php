<?php

return [
    'pgsql' => [
        'host'     => $_ENV['PG_HOST'],
        'port'     => $_ENV['PG_PORT'],
        'database' => $_ENV['PG_DATABASE'],
        'username' => $_ENV['PG_USERNAME'],
        'password' => $_ENV['PG_PASSWORD'],
    ],
];
