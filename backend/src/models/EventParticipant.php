<?php

class EventParticipant
{
    public function __construct(
        private int $eventId,
        private int $userId,
        private string $status
    ) {}

    public function getEventId(): int
    {
        return $this->eventId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
