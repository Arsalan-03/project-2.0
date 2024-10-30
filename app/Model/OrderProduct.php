<?php

namespace Model;

use PDO;

class OrderProduct extends Model
{
    public function addOrderProduct(int $userId, int $orderId): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO order_products (order_id, user_id, product_id, quantity)
                               SELECT :order_id, :user_id, product_id, quantity
                               FROM user_products
                               WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId,'order_id' => $orderId]);
    }
}