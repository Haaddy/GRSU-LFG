<?php

require_once __DIR__ . '/../database/Database.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository
{
    private PDO $connection;

    public function __construct(Database $database)
    {
        $this->connection = $database->getConnection();
    }

    public function findByLogin(string $login): ?User
    {
        $query = $this->connection->prepare(
            'SELECT *
             FROM users
             WHERE login = :login'
        );

        $query->execute([
            'login' => $login
        ]);

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return new User(
            $data['id'],
            $data['login'],
            $data['full_name'],
            $data['password_hash'],
            $data['role']
        );
    }

    public function findById(int $id): ?User
    {
        $query = $this->connection->prepare(
            'SELECT *
             FROM users
             WHERE id = :id'
        );

        $query->execute([
            'id' => $id
        ]);

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return new User(
            $data['id'],
            $data['login'],
            $data['full_name'],
            $data['password_hash'],
            $data['role']
        );
    }

    public function create(User $user): int
    {
        $query = $this->connection->prepare(
            'INSERT INTO users
                (login, full_name, password_hash, role)
             VALUES
                (:login, :full_name, :password_hash, :role)
             RETURNING id'
        );

        $query->execute([
            'login' => $user->login,
            'full_name' => $user->fullName,
            'password_hash' => $user->passwordHash,
            'role' => $user->role
        ]);

        return (int) $query->fetchColumn();
    }

    public function update(int $id, string $fullName): bool
    {
        $query = $this->connection->prepare(
            'UPDATE users
             SET full_name = :full_name
             WHERE id = :id'
        );

        return $query->execute([
            'id' => $id,
            'full_name' => $fullName
        ]);
    }

    public function delete(int $id): bool
    {
        $query = $this->connection->prepare(
            'DELETE FROM users
             WHERE id = :id'
        );

        return $query->execute([
            'id' => $id
        ]);
    }
}