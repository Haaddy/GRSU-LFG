<?php

require_once __DIR__ . '/../services/AuthService.php';

class AuthController
{
    private const AUTH_COOKIE_NAME = 'access_token';
    private const AUTH_COOKIE_TTL = 3600;

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

        if ($contentType !== 'application/json') {
            http_response_code(415);
            return ['error' => 'Content-Type must be application/json'];
        }

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

        foreach (['login', 'full_name', 'email', 'password'] as $field) {
            if (!isset($data[$field]) || !is_string($data[$field])) {
                http_response_code(400);
                return ['error' => "Field '$field' is required and must be a string"];
            }
        }

        try {
            $result = $this->authService->register(
                $data['login'],
                $data['full_name'],
                $data['email'],
                $data['password']
            );

            $user = $result['user'];
            $this->setAuthCookie($result['token']);
        } catch (ValidationException $e) {
            http_response_code(400);
            return ['error' => $e->getMessage()];
        }

        http_response_code(201);


        return [
            'message' => 'User registered successfully',
            'user' => [
                'id' => $user->getId(),
                'login' => $user->getLogin(),
                'full_name' => $user->getFullName(),
                'email' => $user->getEmail()
            ]
        ];
    }

    public function login(array $params = []): array
    {
        $contentType = strtolower(trim(explode(
            ';',
            $_SERVER['CONTENT_TYPE'] ?? ''
        )[0]));

        if ($contentType !== 'application/json') {
            http_response_code(415);
            return ['error' => 'Content-Type must be application/json'];
        }

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

        foreach (['login', 'password'] as $field) {
            if (!isset($data[$field]) || !is_string($data[$field])) {
                http_response_code(400);
                return ['error' => "Field '$field' is required and must be a string"];
            }
        }

        try {
            $result = $this->authService->login(
                $data['login'],
                $data['password']
            );

            $user = $result['user'];
            $this->setAuthCookie($result['token']);
        } catch (ValidationException $e) {
            http_response_code(401);
            return ['error' => $e->getMessage()];
        }
        return [
            'message' => 'Login successful',
            'user' => [
                'id' => $user->getId(),
                'login' => $user->getLogin(),
                'full_name' => $user->getFullName(),
                'email' => $user->getEmail()
            ]
        ];
    }

    public function logout(array $params = []): array
    {
        $isHttps = !empty($_SERVER['HTTPS'])
            && $_SERVER['HTTPS'] !== 'off';

        // Истёкшая cookie заставляет браузер удалить сохранённый JWT.
        $cookieCleared = setcookie(
            self::AUTH_COOKIE_NAME,
            '',
            [
                'expires' => time() - 3600,
                'path' => '/',
                'secure' => $isHttps,
                'httponly' => true,
                'samesite' => 'Lax',
            ]
        );

        if (!$cookieCleared) {
            throw new RuntimeException('Unable to clear authentication cookie');
        }

        return [
            'message' => 'Logout successful'
        ];
    }

    private function setAuthCookie(string $token): void
    {
        // HttpOnly не позволяет JavaScript прочитать JWT из cookie.
        $isHttps = !empty($_SERVER['HTTPS'])
            && $_SERVER['HTTPS'] !== 'off';

        $cookieSet = setcookie(
            self::AUTH_COOKIE_NAME,
            $token,
            [
                'expires' => time() + self::AUTH_COOKIE_TTL,
                'path' => '/',
                'secure' => $isHttps,
                'httponly' => true,
                'samesite' => 'Lax',
            ]
        );

        if (!$cookieSet) {
            throw new RuntimeException('Unable to set authentication cookie');
        }
    }
}