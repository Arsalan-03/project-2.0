<?php

namespace Model;

use PDO;

class OrderProduct
{
    public function addOrderProduct(int $userId, int $orderId): void
    {
        $pdo = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'arsik', '0000');
        $stmt = $pdo->prepare("INSERT INTO order_products (order_id, user_id, product_id, quantity)
                               SELECT :order_id, :user_id, product_id, quantity
                               FROM user_products
                               WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId,'order_id' => $orderId]);
    }
}