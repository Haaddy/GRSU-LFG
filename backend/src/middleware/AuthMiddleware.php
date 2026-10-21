<?php

require_once __DIR__ . '/../repositories/UserRepository.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware
{
 public function __construct(
     private string $secret,
     private UserRepository $userRepository
 ) {}

 public function handle():array{
     $authorization = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
    
     if (!preg_match('/^Bearer\s+(\S+)$/i', $authorization, $matches)) {
            return [
                'ok' => false,
                'status' => 401,
                'error' => 'Bearer token is required'
            ];
    }

    try{
        $decoded = JWT::decode($matches[1], new Key($this->secret, 'HS256'));
        
    } catch (Exception $e) {
        return [
            'ok' => false,
            'status' => 401,
            'error' => 'Invalid token: ' . $e->getMessage()
        ];
    }

    if (!isset($decoded->sub) || filter_var($decoded->sub, FILTER_VALIDATE_INT) === false) {
        return [
            'ok' => false,
            'status' => 401,
            'error' => 'Invalid token payload'
        ];
    }

    $userId = (int) $decoded->sub;
    if ($userId < 1) {
        return [
            'ok' => false,
            'status' => 401,
            'error' => 'Invalid token payload'
        ];
    }

    $user = $this->userRepository->findById($userId);
    if ($user === null) {
        return [
            'ok' => false,
            'status' => 401,
            'error' => 'User from token was not found'
        ];
    }

     return[
            'ok' => true,
            'user_id' => $userId,
            'user' => $user
        ];
 }
}