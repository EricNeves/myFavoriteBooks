<?php

namespace App\Providers\Implementations;

use App\Providers\IDatabaseProvider;
use Exception;
use PDO;

class BookPostgresProvider implements IDatabaseProvider
{
    public function __construct(private PDO $pdo)
    {
    }

    public function create(array $data): bool
    {
        $stmt = $this->pdo->prepare("
            INSERT
            INTO
                mfb_books (title, author, image, user_id)
            VALUES
                (:title, :author, :image, :user_id)
        ");

        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':author', $data['author']);
        $stmt->bindParam(':image', $data['image'], PDO::PARAM_LOB);
        $stmt->bindParam(':user_id', $data['user_id']);

        $stmt->execute();

        return $this->pdo->lastInsertId() > 0;
    }

    public function fetchAll(int | string $user_id = null): array
    {
        $stmt = $this->pdo->prepare("
            SELECT
                *
            FROM
                mfb_books
            WHERE
                user_id = ?
        ");

        $stmt->execute([$user_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByEmail(string $email): array | bool
    {
        throw new Exception("Method not implemented");
    }

    public function findById(int | string $id, int | string $user_id = null): array | bool
    {
        throw new Exception("Method not implemented");
    }

    public function update(array $data, int | string $userId): bool
    {
        throw new Exception("Method not implemented");
    }
}
