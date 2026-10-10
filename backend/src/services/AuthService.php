<?php

require_once __DIR__ . '/../repositories/UserRepository.php';
require_once __DIR__ . '/../models/User.php';

class AuthService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(
        string $login,
        string $fullName,
        string $email,
        string $password
    ): User {
        $login = trim($login);
        $fullName = trim($fullName);
        $email = trim($email);

        if (
            $login === ''
            || $fullName === ''
            || $email === ''
            || $password === ''
        ) {
            throw new InvalidArgumentException(
                'Login, full name, email and password are required'
            );
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email format');
        }

        if ($this->characterLength($login) > 50) {
            throw new InvalidArgumentException(
                'Login must be no longer than 50 characters'
            );
        }

        if ($this->characterLength($fullName) > 100) {
            throw new InvalidArgumentException(
                'Full name must be no longer than 100 characters'
            );
        }

        if (strlen($password) < 6) {
            throw new InvalidArgumentException(
                'Password must be at least 6 characters long'
            );
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        if ($passwordHash === false) {
            throw new RuntimeException('Unable to hash the password');
        }


        $user = new User(
            null,
            $login,
            $fullName,
            $passwordHash,
            'student',
            $email
        );

        $user->id = $this->userRepository->create($user);

        return $user;
    }

    private function characterLength(string $value): int
    {
        $length = preg_match_all('/./us', $value);
        if ($length === false) {
            throw new InvalidArgumentException('Input must be valid UTF-8');
        }

        return $length;
    }
}