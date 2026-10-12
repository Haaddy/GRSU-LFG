<?php

class Team
{
    public function __construct(
        private ?int $id,
        private int $eventId,
        private string $name,
        private int $captainId
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEventId(): int
    {
        return $this->eventId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCaptainId(): int
    {
        return $this->captainId;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
