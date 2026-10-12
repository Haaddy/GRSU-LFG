<?php

require_once __DIR__ . '/../database/Database.php';
require_once __DIR__ . '/../models/EventParticipant.php';

class EventParticipantRepository
{
    private PDO $connection;

    public function __construct(Database $database)
    {
        $this->connection = $database->getConnection();
    }

    public function find(int $eventId, int $userId): ?EventParticipant
    {
        $query = $this->connection->prepare(
            'SELECT *
             FROM event_participants
             WHERE event_id = :event_id
               AND user_id = :user_id'
        );

        $query->execute([
            'event_id' => $eventId,
            'user_id' => $userId
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
             FROM event_participants
             WHERE event_id = :event_id'
        );

        $query->execute([
            'event_id' => $eventId
        ]);

        $participants = [];

        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $data) {
            $participants[] = $this->map($data);
        }

        return $participants;
    }

    public function findByUserId(int $userId): array
    {
        $query = $this->connection->prepare(
            'SELECT *
             FROM event_participants
             WHERE user_id = :user_id'
        );

        $query->execute([
            'user_id' => $userId
        ]);

        $participants = [];

        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $data) {
            $participants[] = $this->map($data);
        }

        return $participants;
    }

    public function create(EventParticipant $participant): bool
    {
        $query = $this->connection->prepare(
            'INSERT INTO event_participants
                (event_id, user_id, status)
             VALUES
                (:event_id, :user_id, :status)'
        );

        return $query->execute([
            'event_id' => $participant->getEventId(),
            'user_id' => $participant->getUserId(),
            'status' => $participant->getStatus()
        ]);
    }

    public function update(int $eventId, int $userId, string $status): bool
    {
        $query = $this->connection->prepare(
            'UPDATE event_participants
             SET status = :status
             WHERE event_id = :event_id
               AND user_id = :user_id'
        );

        return $query->execute([
            'event_id' => $eventId,
            'user_id' => $userId,
            'status' => $status
        ]);
    }

    public function delete(int $eventId, int $userId): bool
    {
        $query = $this->connection->prepare(
            'DELETE FROM event_participants
             WHERE event_id = :event_id
               AND user_id = :user_id'
        );

        return $query->execute([
            'event_id' => $eventId,
            'user_id' => $userId
        ]);
    }

    private function map(array $data): EventParticipant
    {
        return new EventParticipant(
            (int) $data['event_id'],
            (int) $data['user_id'],
            $data['status']
        );
    }
}
