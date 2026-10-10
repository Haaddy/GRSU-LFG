<?php

require_once __DIR__ . '/../services/AuthService.php';

class AuthController
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(array $params = []): array
    {
        $contentType = strtolower(trim(explode(
            ';',
            $_SERVER['CONTENT_TYPE'] ?? ''
        )[0]));

        if ($contentType === 'application/json') {
            $rawData = file_get_contents('php://input');
            if ($rawData === false) {
                http_response_code(500);
                return ['error' => 'Unable to read request body'];
            }

            try {
                $decodedData = json_decode(
                    $rawData,
                    false,
                    512,
                    JSON_THROW_ON_ERROR
                );
            } catch (JsonException $e) {
                http_response_code(400);
                return ['error' => 'Invalid JSON'];
            }

            if (!$decodedData instanceof stdClass) {
                http_response_code(400);
                return ['error' => 'Expected a JSON object'];
            }

            $data = get_object_vars($decodedData);
        } elseif (
            $contentType === 'application/x-www-form-urlencoded'
            || $contentType === 'multipart/form-data'
        ) {
            $data = $_POST;
        } else {
            http_response_code(415);
            return ['error' => 'Unsupported content type'];
        }

        foreach (['login', 'full_name', 'email', 'password'] as $field) {
            if (!isset($data[$field]) || !is_string($data[$field])) {
                http_response_code(400);
                return ['error' => "Field '$field' is required and must be a string"];
            }
        }

        try {
            $user = $this->authService->register(
                $data['login'],
                $data['full_name'],
                $data['email'],
                $data['password']
            );
        } catch (InvalidArgumentException $e) {
            http_response_code(400);
            return ['error' => $e->getMessage()];
        }

        http_response_code(201);
        return [
            'message' => 'User registered successfully',
            'user' => [
                'id' => $user->id,
                'login' => $user->login,
                'full_name' => $user->fullName,
                'email' => $user->email
            ]
        ];
    }
}