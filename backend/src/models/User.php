<?php

class User
{
    public function __construct(
        private ?int $id,
        private string $login,
        private string $fullName,
        private string $passwordHash,
        private string $role,
        private string $email = ''
    ) {}


    public function getId(): ?int
    {
        return $this->id;
    }
    public function getEmail(): string
    {
        return $this->email;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }


    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }
}