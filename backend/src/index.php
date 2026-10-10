<?php

require_once __DIR__ . '/router/Router.php';
require_once __DIR__ . '/database/Database.php';
require_once __DIR__ . '/repositories/UserRepository.php';
require_once __DIR__ . '/services/AuthService.php';
require_once __DIR__ . '/controllers/UserController.php';
require_once __DIR__ . '/controllers/AuthController.php';

$router = new Router();

$userController = new UserController();
$database = new Database();
$userRepository = new UserRepository($database);
$authService = new AuthService($userRepository);
$authController = new AuthController($authService);

$router->get(
    '/api/user',
    [$userController, 'getUser']
);

$router->post(
    '/api/auth/register',
    [$authController, 'register']
);

$router->run();