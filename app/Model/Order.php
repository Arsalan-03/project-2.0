<?php

namespace Model;

use PDO;

class Order extends Model
{
    public function addOrder(string $email, string $phone, string $name, string $address, string $city, string $country,int $postal)
    {
        $stmt = $this->pdo->prepare("INSERT INTO orders(email, phone, name, address, city, country, postal) VALUES (:email, :phone, :name, :address, :city, :country, :postal) RETURNING id");
        $stmt->execute(['email' => $email, 'phone' => $phone, 'name' => $name, 'address' => $address, 'city' => $city, 'country' => $country, 'postal' => $postal]);

        return $stmt->fetchColumn();
    }

//    public function getOrderId(int $userId)
//    {
//        $pdo = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'arsik', '0000');
//        $stmt = $pdo->prepare("SELECT id FROM orders WHERE user_id = :user_id ORDER BY id DESC LIMIT 1");
//        $stmt->execute(['user_id' => $userId]);
//        $result = $stmt->fetch();
//        return $result;
//    }
}