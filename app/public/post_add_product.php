<?php

define('ERROR_PRODUCT_ID_REQUIRED', 'Поле product-id не должно быть пустым');
define('ERROR_QUANTITY_REQUIRED', 'Поле quantity не должно быть пустым');

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: /login");
    exit();
} else {

    $errors = [];

    if (isset($_POST['product_id'])) {
        $productId = htmlspecialchars($_POST['product_id'], ENT_QUOTES, 'UTF-8');
    } elseif (empty($productId)) {
        $errors['product-id'] = ERROR_PRODUCT_ID_REQUIRED;
    } elseif (isset($_POST['quantity'])) {
        $quantity = htmlspecialchars($_POST['quantity'], ENT_QUOTES, 'UTF-8');
    } elseif (empty($quantity)) {
        $errors['quantity'] = ERROR_QUANTITY_REQUIRED;
    }
}

if (empty($errors)) {

    $userId = $_SESSION['login'];
    $productId = htmlspecialchars($_POST['product_id'], ENT_QUOTES, 'UTF-8');
    $quantity = htmlspecialchars($_POST['quantity'], ENT_QUOTES, 'UTF-8');

    try {

        $pdo = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'arsik', '0000');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO user_products (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'quantity' => $quantity]);

    } catch (PDOException $e) {
        echo "Ошибка при сохранении данных: " . $e->getMessage();
    }
}

require_once './get_add_product.php';

