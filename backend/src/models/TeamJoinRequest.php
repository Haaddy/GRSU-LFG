<?php

class TeamJoinRequest
{
    public function __construct(
        private ?int $id,
        private int $teamId,
        private int $userId,
        private string $status
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeamId(): int
    {
        return $this->teamId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
