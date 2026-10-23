<?php

class UserController {
    

    public function getProfile(array $params): array{
    return [
        'message' => 'Middleware allowed the request',
        'user_id' => $params['auth']['user_id']
    ];
}
}