<?php

namespace App\Providers\Implementations;

use App\Providers\IDatabaseProvider;
use PDO;

class UserPostgresProvider implements IDatabaseProvider
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

        return $this->pdo->lastInsertId() > 0;
    }

    public function findByEmail(string $email): array | bool
    {
        $stmt = $this->pdo->prepare("
            SELECT
                *
            FROM
                mfb_users
            WHERE
                email = ?
        ");

        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): array | bool
    {
        $stmt = $this->pdo->prepare("
            SELECT
                id, username, email
            FROM
                mfb_users
            WHERE
                id = ?
        ");

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(array $data, int | string $userId): bool
    {
        $stmt = $this->pdo->prepare("
            UPDATE
                mfb_users
            SET
                username = ?
            WHERE
                id = ?
        ");

        $stmt->execute([
            $data['username'],
            $userId,
        ]);

        return $stmt->rowCount() > 0;
    }
}
