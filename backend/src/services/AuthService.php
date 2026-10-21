<?php

require_once __DIR__ . '/../repositories/UserRepository.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/JwtService.php';
require_once __DIR__ . '/../exceptions/ValidationException.php';

class AuthService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository, private JwtService $jwtService)
    {
        $this->userRepository = $userRepository;
    }

    private function validateRegistrationData(
        string $login,
        string $fullName,
        string $email,
        string $password
    ): void {
        if (
            $login === ''
            || $fullName === ''
            || $email === ''
            || $password === ''
        ) {
            throw new ValidationException(
                'Login, full name, email and password are required'
            );
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException('Invalid email format');
        }

        if ($this->characterLength($email) > 100) {
            throw new ValidationException(
                'Email must be no longer than 100 characters'
            );
        }

        if ($this->characterLength($login) > 50) {
            throw new ValidationException(
                'Login must be no longer than 50 characters'
            );
        }

        if ($this->characterLength($fullName) > 100) {
            throw new ValidationException(
                'Full name must be no longer than 100 characters'
            );
        }

        if (strlen($password) < 6) {
            throw new ValidationException(
                'Password must be at least 6 characters long'
            );
        }

        if ($this->userRepository->findByLogin($login) !== null) {
            throw new ValidationException('Login is already taken');
        }

        if ($this->userRepository->findByEmail($email) !== null) {
            throw new ValidationException('Email is already taken');
        }

    }

    private function validateLoginData(User $user, string $password): void
    {
        if (!password_verify($password, $user->getPasswordHash())) {
            throw new ValidationException('Invalid login or password');
        }
    }

    public function register(
        string $login,
        string $fullName,
        string $email,
        string $password
    ) : array {
        $login = trim($login);
        $fullName = trim($fullName);
        $email = trim($email);

        $this->validateRegistrationData($login, $fullName, $email, $password);

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

        $user->setId($this->userRepository->create($user));
        $token = $this->jwtService->generateToken($user);

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function login(string $login, string $password): array
    {
        $login = trim($login);
        if ($login === '' || $password === '') {
            throw new ValidationException(
                'Login and password are required'
            );
        }

        $user = $this->userRepository->findByLogin($login);
        if ($user === null) {
            throw new ValidationException('Invalid login or password');
        }

        $this->validateLoginData($user, $password);

        $token = $this->jwtService->generateToken($user);

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    private function characterLength(string $value): int
    {
        $length = preg_match_all('/./us', $value);
        if ($length === false) {
            throw new ValidationException('Input must be valid UTF-8');
        }

        return $length;
    }
}