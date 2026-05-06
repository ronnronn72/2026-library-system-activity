<?php

declare(strict_types=1);

namespace App\Library\Config;

use mysqli;
use RuntimeException;

class DatabaseConnection
{
    private mysqli $connection;

    public function __construct(
        private string $host,
        private string $username,
        private string $password,
        private string $database
    ) {
        $this->connect();
    }

    private function connect(): void
    {
        $this->connection = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->database
        );

        if ($this->connection->connect_error) {
            throw new RuntimeException('Database connection failed');
        }
    }

    public function getConnection(): mysqli
    {
        return $this->connection;
    }
}