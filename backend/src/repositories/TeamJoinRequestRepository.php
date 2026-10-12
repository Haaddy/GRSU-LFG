<?php

require_once __DIR__ . '/../database/Database.php';
require_once __DIR__ . '/../models/TeamJoinRequest.php';

class TeamJoinRequestRepository
{
    private PDO $connection;

    public function __construct(Database $database)
    {
        $this->connection = $database->getConnection();
    }

    public function findById(int $id): ?TeamJoinRequest
    {
        $query = $this->connection->prepare(
            'SELECT *
             FROM team_join_requests
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

    public function findByTeamId(int $teamId): array
    {
        $query = $this->connection->prepare(
            'SELECT *
             FROM team_join_requests
             WHERE team_id = :team_id
             ORDER BY id'
        );

        $query->execute([
            'team_id' => $teamId
        ]);

        $requests = [];

        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $data) {
            $requests[] = $this->map($data);
        }

        return $requests;
    }

    public function findByUserId(int $userId): array
    {
        $query = $this->connection->prepare(
            'SELECT *
             FROM team_join_requests
             WHERE user_id = :user_id
             ORDER BY id'
        );

        $query->execute([
            'user_id' => $userId
        ]);

        $requests = [];

        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $data) {
            $requests[] = $this->map($data);
        }

        return $requests;
    }

    public function create(TeamJoinRequest $request): int
    {
        $query = $this->connection->prepare(
            'INSERT INTO team_join_requests
                (team_id, user_id, status)
             VALUES
                (:team_id, :user_id, :status)
             RETURNING id'
        );

        $query->execute([
            'team_id' => $request->getTeamId(),
            'user_id' => $request->getUserId(),
            'status' => $request->getStatus()
        ]);

        return (int) $query->fetchColumn();
    }

    public function update(int $id, string $status): bool
    {
        $query = $this->connection->prepare(
            'UPDATE team_join_requests
             SET status = :status
             WHERE id = :id'
        );

        return $query->execute([
            'id' => $id,
            'status' => $status
        ]);
    }

    public function delete(int $id): bool
    {
        $query = $this->connection->prepare(
            'DELETE FROM team_join_requests
             WHERE id = :id'
        );

        return $query->execute([
            'id' => $id
        ]);
    }

    private function map(array $data): TeamJoinRequest
    {
        return new TeamJoinRequest(
            (int) $data['id'],
            (int) $data['team_id'],
            (int) $data['user_id'],
            $data['status']
        );
    }
}
