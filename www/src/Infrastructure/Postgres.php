<?php

namespace App\Infrastructure;

use PDO;

class Postgres
{
    public static function connect(array $config): PDO
    {
        $pdo = new PDO(
            "pgsql:host={$config['pgsql']['host']};port={$config['pgsql']['port']};dbname={$config['pgsql']['database']};",
            $config['pgsql']['username'],
            $config['pgsql']['password']);

        return $pdo;
    }
}
