<?php

class Database
{
    private PDO $connection;

    public function __construct()
    {
        $envFile = dirname(__DIR__, 2) . '/.env';
        $fileConfig = [];

        if (is_file($envFile)) {
            $parsedConfig = parse_ini_file(
                $envFile,
                false,
                INI_SCANNER_RAW
            );

            if ($parsedConfig === false) {
                throw new RuntimeException('Unable to read backend/.env');
            }

            $fileConfig = $parsedConfig;
        }

        foreach ($fileConfig as $key => $value) {
            $environmentValue = $_ENV[$key] ?? getenv($key);
            if ($environmentValue === false || $environmentValue === null) {
                $_ENV[$key] = $value;
            }
        }

        $config = [];
        foreach (['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASSWORD'] as $key) {
            $value = $_ENV[$key] ?? getenv($key);
            if ($value === false || $value === null) {
                $value = $fileConfig[$key] ?? null;
            }

            if (!is_string($value)) {
                throw new RuntimeException(
                    "Missing database configuration: $key"
                );
            }

            $_ENV[$key] = $value;
            $config[$key] = $value;
        }

        $host = $config['DB_HOST'];
        $database = $config['DB_NAME'];
        $user = $config['DB_USER'];
        $password = $config['DB_PASSWORD'];

        $this->connection = new PDO(
            "pgsql:host=$host;dbname=$database",
            $user,
            $password
        );

        $this->connection->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}