<?php

namespace Model;

use PDO;

class Users
{

    public function create(string $name, string $email, string $hashedPassword): void
    {
        $pdo = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'arsik', '0000');
        // Вставляем данные в таблицу
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $stmt->execute(['name' => $name, 'email' => $email, 'password' => $hashedPassword]);
    }

    public function getUserByEmail(string $login): array
    {
        $pdo = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'arsik', '0000');
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :login");
        $stmt->execute(['login' => $login]);

        return $stmt->fetch();
    }
}