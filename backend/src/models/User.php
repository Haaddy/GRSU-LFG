<?php

class User
{
    public function __construct(
        public ?int $id,
        public string $login,
        public string $fullName,
        public string $passwordHash,
        public string $role
    ) {}
}