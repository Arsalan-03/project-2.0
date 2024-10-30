<?php

namespace Model;

use PDO;

class Product extends Model
{
    public function getProducts(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM products");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}