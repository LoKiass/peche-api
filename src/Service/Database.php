<?php

namespace App\Service;

use PDO;
use PDOException;
use Symfony\Component\Dotenv\Dotenv;

class Database {
    private PDO $pdo;
    private string $host;
    private string $dbName;
    private string $username;
    private string $password;

    public function __construct(){
        // Loading environment variables from .env file
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__ . '/../../.env');

        // Getting information from the env files
        $this->host = $_ENV['DB_HOST'];
        $this->dbName = $_ENV['DB_NAME'];
        $this->username = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASSWORD'];

        // Creating a new PDO instance
        try {
            $this->pdo = new PDO("pgsql:host={$this->host};dbname={$this->dbName}", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getConnection(){
        return $this->pdo;
    }
}