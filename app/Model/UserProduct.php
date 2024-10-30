<?php

namespace Model;

use PDO;

class UserProduct extends Model
{
    public function getCart(int $userId): array
    {
        $stmt = $this->pdo->prepare("SELECT up.id, u.id, u.name AS user_name, u.email, u.password, 
        p.id, p.name, p.image, p.info, p.price, up.quantity FROM user_products up
        JOIN users u ON up.user_id = u.id
        JOIN products p ON up.product_id = p.id
        WHERE u.id = :user_id;");

        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkIdProduct(int $productId)
    {
        $stmt = $this->pdo->prepare("SELECT id FROM products WHERE id = :product_id;");
        $stmt->execute(['product_id' => $productId]);
        return $stmt->fetch();
    }

    public function checkProductInCart(int $userId, int $productId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user_products WHERE user_id = :user_id AND product_id = :product_id;");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
        return $stmt->fetch();
    }

    public function addProductToCart(int $userId, int $productId, int $quantity): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO user_products (user_id, product_id, quantity) VALUES (:user_id, :product_id, 1)");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'quantity' => $quantity]);
    }

    public function updateProductQuantity(int $newAmount, int $userId, int $productId): void
    {
        $stmt = $this->pdo->prepare("UPDATE user_products SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id;");
        $stmt->execute(['quantity' => $newAmount, 'user_id' => $userId, 'product_id' => $productId]);
    }

    public function deleteProductsInCart(int $userId): array|false
    {
        $stmt = $this->pdo->prepare("DELETE FROM user_products WHERE user_id = :user_id;");
        $stmt->execute(['user_id' => $userId]);

        return $stmt->fetch();
    }
 }