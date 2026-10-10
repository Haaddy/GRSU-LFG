<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware{
 public function __construct(private string $secret) {}

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

    if (
        !isset($decoded->sub)
        || !is_numeric($decoded->sub)
        || (int) $decoded->sub < 1
    ) {
        return [
            'ok' => false,
            'status' => 401,
            'error' => 'Invalid token payload'
        ];
    }
     return[
            'ok' => true,
            'user_id' => $decoded->sub
        ];
 }
}