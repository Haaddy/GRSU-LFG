<?php

require_once __DIR__ . '/router/Router.php';
require_once __DIR__ . '/repositories/UserRepository.php';
require_once __DIR__ . '/controllers/UserController.php';

echo "Backend is running!";

$router = new Router();

$userController = new UserController();

$router->get(
    '/api/user',
    [$userController, 'getUser']
);

$router->run();