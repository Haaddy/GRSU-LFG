<?php

require_once __DIR__ . '/../database/Database.php';
require_once __DIR__ . '/../models/Team.php';

class TeamRepository
{
    private PDO $connection;

    public function __construct(Database $database)
    {
        $this->connection = $database->getConnection();
    }

    public function findById(int $id): ?Team
    {
        $query = $this->connection->prepare(
            'SELECT *
             FROM teams
             WHERE id = :id'
        );

        $query->execute([
            'id' => $id
        ]);

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return $this->map($data);
    }

    public function findByEventId(int $eventId): array
    {
        $query = $this->connection->prepare(
            'SELECT *
             FROM teams
             WHERE event_id = :event_id
             ORDER BY id'
        );

        $query->execute([
            'event_id' => $eventId
        ]);

        $teams = [];

        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $data) {
            $teams[] = $this->map($data);
        }

        return $teams;
    }

    public function create(Team $team): int
    {
        $query = $this->connection->prepare(
            'INSERT INTO teams
                (event_id, name, captain_id)
             VALUES
                (:event_id, :name, :captain_id)
             RETURNING id'
        );

        $query->execute([
            'event_id' => $team->getEventId(),
            'name' => $team->getName(),
            'captain_id' => $team->getCaptainId()
        ]);

        return (int) $query->fetchColumn();
    }

    public function update(int $id, string $name): bool
    {
        $query = $this->connection->prepare(
            'UPDATE teams
             SET name = :name
             WHERE id = :id'
        );

        return $query->execute([
            'id' => $id,
            'name' => $name
        ]);
    }

    public function delete(int $id): bool
    {
        $query = $this->connection->prepare(
            'DELETE FROM teams
             WHERE id = :id'
        );

        return $query->execute([
            'id' => $id
        ]);
    }

    private function map(array $data): Team
    {
        return new Team(
            (int) $data['id'],
            (int) $data['event_id'],
            $data['name'],
            (int) $data['captain_id']
        );
    }
}
