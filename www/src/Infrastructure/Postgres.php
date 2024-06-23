<?php

namespace App\Infrastructure;

use PDO;

class Postgres
{
    public static function connect(array $config): PDO
    {
        $host     = $config['pgsql']['host'];
        $port     = $config['pgsql']['port'];
        $dbname   = $config['pgsql']['database'];
        $username = $config['pgsql']['username'];
        $password = $config['pgsql']['password'];

        $dns = "pgsql:host=$host;port=$port;dbname=$dbname;";

        $pdo = new PDO($dns, $username, $password);

        return $pdo;
    }
}
