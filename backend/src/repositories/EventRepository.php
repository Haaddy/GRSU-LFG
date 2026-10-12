<?php

require_once __DIR__ . '/../database/Database.php';
require_once __DIR__ . '/../models/Event.php';

class EventRepository
{
    private PDO $connection;

    public function __construct(Database $database)
    {
        $this->connection = $database->getConnection();
    }

    public function findById(int $id): ?Event
    {
        $query = $this->connection->prepare(
            'SELECT *
             FROM events
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

    public function findByOrganizerId(int $organizerId): array
    {
        $query = $this->connection->prepare(
            'SELECT *
             FROM events
             WHERE organizer_id = :organizer_id
             ORDER BY start_at'
        );

        $query->execute([
            'organizer_id' => $organizerId
        ]);

        $events = [];

        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $data) {
            $events[] = $this->map($data);
        }

        return $events;
    }

    public function create(Event $event): int
    {
        $query = $this->connection->prepare(
            'INSERT INTO events
                (name, description, start_at, end_at, location, need_team,
                 organizer_id, max_participants, max_teams,
                 min_team_members, max_team_members)
             VALUES
                (:name, :description, :start_at, :end_at, :location, :need_team,
                 :organizer_id, :max_participants, :max_teams,
                 :min_team_members, :max_team_members)
             RETURNING id'
        );

        $query->execute([
            'name' => $event->getName(),
            'description' => $event->getDescription(),
            'start_at' => $event->getStartAt(),
            'end_at' => $event->getEndAt(),
            'location' => $event->getLocation(),
            'need_team' => $event->getNeedTeam() ? 'true' : 'false',
            'organizer_id' => $event->getOrganizerId(),
            'max_participants' => $event->getMaxParticipants(),
            'max_teams' => $event->getMaxTeams(),
            'min_team_members' => $event->getMinTeamMembers(),
            'max_team_members' => $event->getMaxTeamMembers()
        ]);

        return (int) $query->fetchColumn();
    }

    public function update(Event $event): bool
    {
        $query = $this->connection->prepare(
            'UPDATE events
             SET name = :name,
                 description = :description,
                 start_at = :start_at,
                 end_at = :end_at,
                 location = :location,
                 need_team = :need_team,
                 max_participants = :max_participants,
                 max_teams = :max_teams,
                 min_team_members = :min_team_members,
                 max_team_members = :max_team_members
             WHERE id = :id'
        );

        return $query->execute([
            'id' => $event->getId(),
            'name' => $event->getName(),
            'description' => $event->getDescription(),
            'start_at' => $event->getStartAt(),
            'end_at' => $event->getEndAt(),
            'location' => $event->getLocation(),
            'need_team' => $event->getNeedTeam() ? 'true' : 'false',
            'max_participants' => $event->getMaxParticipants(),
            'max_teams' => $event->getMaxTeams(),
            'min_team_members' => $event->getMinTeamMembers(),
            'max_team_members' => $event->getMaxTeamMembers()
        ]);
    }

    public function delete(int $id): bool
    {
        $query = $this->connection->prepare(
            'DELETE FROM events
             WHERE id = :id'
        );

        return $query->execute([
            'id' => $id
        ]);
    }

    private function map(array $data): Event
    {
        return new Event(
            (int) $data['id'],
            $data['name'],
            $data['description'],
            $data['start_at'],
            $data['end_at'],
            $data['location'],
            $this->toBool($data['need_team']),
            (int) $data['organizer_id'],
            $data['max_participants'] !== null ? (int) $data['max_participants'] : null,
            $data['max_teams'] !== null ? (int) $data['max_teams'] : null,
            $data['min_team_members'] !== null ? (int) $data['min_team_members'] : null,
            $data['max_team_members'] !== null ? (int) $data['max_team_members'] : null
        );
    }

    private function toBool(mixed $value): bool
    {
        if (is_bool($value)) {
            return $value;
        }

        return in_array(strtolower((string) $value), ['1', 't', 'true', 'yes', 'on'], true);
    }
}
