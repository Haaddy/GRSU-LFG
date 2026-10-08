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
}