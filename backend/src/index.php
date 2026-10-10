<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/router/Router.php';
require_once __DIR__ . '/database/Database.php';
require_once __DIR__ . '/repositories/UserRepository.php';
require_once __DIR__ . '/services/AuthService.php';
require_once __DIR__ . '/controllers/UserController.php';
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/middleware/AuthMiddleware.php';
$router = new Router();

$userController = new UserController();
$database = new Database();
$userRepository = new UserRepository($database);

$jwtSecret = $_ENV['JWT_SECRET'] ?? null;
if (!is_string($jwtSecret) || $jwtSecret === '') {
    throw new RuntimeException('Missing JWT configuration: JWT_SECRET');
}

$jwtService = new JwtService($jwtSecret, 3600);
$authService = new AuthService($userRepository, $jwtService);
$authController = new AuthController($authService);
$authMiddleware = new AuthMiddleware($jwtSecret);

$router->get(
    '/api/user',
    [$userController, 'getUser']
);

$router->post(
    '/api/auth/register',
    [$authController, 'register']
);

$router->post(
    '/api/auth/login',
    [$authController, 'login']
);

// * test route

$router->get('/api/profile', [$userController, 'getProfile'], [$authMiddleware]);

$router->run();