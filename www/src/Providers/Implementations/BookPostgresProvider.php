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

    public function lastInsertId(): int | string
    {
        return $this->pdo->lastInsertId();
    }

    public function create(array $data): bool
    {
        $stmt = $this->pdo->prepare("
            INSERT
            INTO
                mfb_books (title, author, rating, image, user_id)
            VALUES
                (:title, :author, :rating, :image, :user_id)
        ");

        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':author', $data['author']);
        $stmt->bindParam(':rating', $data['rating']);
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
        $stmt = $this->pdo->prepare("
            SELECT
                *
            FROM
                mfb_books
            WHERE
                id = ?
            AND
                user_id = ?
        ");

        $stmt->execute([$id, $user_id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(array $data, int | string $user_id): bool
    {
        $stmt = $this->pdo->prepare("
            UPDATE
                mfb_books
            SET
                title  = :title,
                author = :author,
                rating = :rating,
                image  = :image
            WHERE
                id = :id
            AND
                user_id = :user_id
        ");

        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':author', $data['author']);
        $stmt->bindParam('rating', $data['rating']);
        $stmt->bindParam(':image', $data['image'], PDO::PARAM_LOB);
        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':user_id', $user_id);

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }

    public function delete(int | string $id, int | string $user_id = null): bool
    {
        $stmt = $this->pdo->prepare("
            DELETE
            FROM
                mfb_books
            WHERE
                id = ?
            AND
                user_id = ?
        ");

        $stmt->execute([$id, $user_id]);

        return $stmt->rowCount() > 0;
    }
}
