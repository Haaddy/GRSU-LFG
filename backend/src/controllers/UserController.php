<?php

class UserController {
    public function getUser(){

        echo "Router work";
         return
            [
                'id' => 1,
            'login' => 'alex123',
            'fullName' => 'Alexey Ivanov',
            'role' => 'student'
            ];
         
    }

    public function getProfile(array $params): array
{
    return [
        'message' => 'Middleware allowed the request',
        'user_id' => $params['auth']['user_id']
    ];
}
}