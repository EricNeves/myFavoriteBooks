<?php

namespace App\Providers\Implementations;

use App\Providers\IDatabaseProvider;
use PDO;

class PostgresProvider implements IDatabaseProvider
{
    public function __construct(private PDO $pdo)
    {
    }

    public function create(array $data): bool
    {
        $stmt = $this->pdo->prepare("
            INSERT
            INTO
                mfb_users (username, email, password)
            VALUES
                (?, ?, ?)
        ");

        $stmt->execute([
            $data['username'],
            $data['email'],
            $data['password'],
        ]);

        if (!$this->pdo->lastInsertId() > 0) {
            return false;
        }

        return true;
    }
}
