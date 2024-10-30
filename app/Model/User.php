<?php

namespace Model;

class User extends Model
{
    public function create(string $name, string $email, string $hashedPassword): void
    {
        // Вставляем данные в таблицу
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $stmt->execute(['name' => $name, 'email' => $email, 'password' => $hashedPassword]);
    }

    public function getUserByEmail(string $login): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :login");
        $stmt->execute(['login' => $login]);

        return $stmt->fetch();
    }
}