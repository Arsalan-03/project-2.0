<?php

namespace Model;

use PDO;

class UserProducts
{
    public function getCart(int $userId): array
    {
        $pdo = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'arsik', '0000');

        $stmt = $pdo->prepare("SELECT up.id, u.id, u.name AS user_name, u.email, u.password, 
        p.id, p.name, p.image, p.info, p.price, up.quantity FROM user_products up
        JOIN users u ON up.user_id = u.id
        JOIN products p ON up.product_id = p.id
        WHERE u.id = :user_id;");

        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addProductCart(int $userId, int $productId, int $quantity): void
    {
        $pdo = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'arsik', '0000');
        $stmt = $pdo->prepare("INSERT INTO user_products (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'quantity' => $quantity]);
    }
}