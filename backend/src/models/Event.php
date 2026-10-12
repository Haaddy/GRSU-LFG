<?php

class Event
{
    public function __construct(
        private ?int $id,
        private string $name,
        private ?string $description,
        private string $startAt,
        private string $endAt,
        private ?string $location,
        private bool $needTeam,
        private int $organizerId,
        private ?int $maxParticipants,
        private ?int $maxTeams,
        private ?int $minTeamMembers,
        private ?int $maxTeamMembers
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getStartAt(): string
    {
        return $this->startAt;
    }

    public function getEndAt(): string
    {
        return $this->endAt;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function getNeedTeam(): bool
    {
        return $this->needTeam;
    }

    public function getOrganizerId(): int
    {
        return $this->organizerId;
    }

    public function getMaxParticipants(): ?int
    {
        return $this->maxParticipants;
    }

    public function getMaxTeams(): ?int
    {
        return $this->maxTeams;
    }

    public function getMinTeamMembers(): ?int
    {
        return $this->minTeamMembers;
    }

    public function getMaxTeamMembers(): ?int
    {
        return $this->maxTeamMembers;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
