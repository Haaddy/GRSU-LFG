<?php

use Firebase\JWT\JWT;
class JwtService{

public function __construct(private string $secret, private int $ttlSeconds){}

    public function generateToken(User $user): string
    {
       if($user->getId() === null) {
            throw new InvalidArgumentException('User ID is required to generate token');
        }

        $now = time();
        $payload = [
            'sub' => $user->getId(),
            'email' => $user->getEmail(),
            'iat' => $now,
            'exp' => $now + $this->ttlSeconds,
        ];

        return JWT::encode($payload, $this->secret, 'HS256');
    }
}