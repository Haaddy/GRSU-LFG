<?php

require_once __DIR__ . '/../database/Database.php';
require_once __DIR__ . '/../models/TeamMember.php';

class TeamMemberRepository
{
    private PDO $connection;

    public function __construct(Database $database)
    {
        $this->connection = $database->getConnection();
    }

    public function find(int $teamId, int $userId): ?TeamMember
    {
        $query = $this->connection->prepare(
            'SELECT *
             FROM team_members
             WHERE team_id = :team_id
               AND user_id = :user_id'
        );

        $query->execute([
            'team_id' => $teamId,
            'user_id' => $userId
        ]);

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return $this->map($data);
    }

    public function findByTeamId(int $teamId): array
    {
        $query = $this->connection->prepare(
            'SELECT *
             FROM team_members
             WHERE team_id = :team_id'
        );

        $query->execute([
            'team_id' => $teamId
        ]);

        $members = [];

        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $data) {
            $members[] = $this->map($data);
        }

        return $members;
    }

    public function findByUserId(int $userId): array
    {
        $query = $this->connection->prepare(
            'SELECT *
             FROM team_members
             WHERE user_id = :user_id'
        );

        $query->execute([
            'user_id' => $userId
        ]);

        $members = [];

        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $data) {
            $members[] = $this->map($data);
        }

        return $members;
    }

    public function create(TeamMember $member): bool
    {
        $query = $this->connection->prepare(
            'INSERT INTO team_members
                (team_id, user_id)
             VALUES
                (:team_id, :user_id)'
        );

        return $query->execute([
            'team_id' => $member->getTeamId(),
            'user_id' => $member->getUserId()
        ]);
    }

    public function delete(int $teamId, int $userId): bool
    {
        $query = $this->connection->prepare(
            'DELETE FROM team_members
             WHERE team_id = :team_id
               AND user_id = :user_id'
        );

        return $query->execute([
            'team_id' => $teamId,
            'user_id' => $userId
        ]);
    }

    private function map(array $data): TeamMember
    {
        return new TeamMember(
            (int) $data['team_id'],
            (int) $data['user_id']
        );
    }
}
