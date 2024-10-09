<?php

namespace Model;

use PDO;

class Products
{
    public function getProducts(): array
    {
        $pdo = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'arsik', '0000');
        $stmt = $pdo->query("SELECT * FROM products");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}