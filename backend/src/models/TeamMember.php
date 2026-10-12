<?php

class TeamMember
{
    public function __construct(
        private int $teamId,
        private int $userId
    ) {}

    public function getTeamId(): int
    {
        return $this->teamId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}
