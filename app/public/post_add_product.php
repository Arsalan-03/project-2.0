<?php

define('ERROR_PRODUCT_ID_REQUIRED', 'Поле product-id не должно быть пустым');
define('ERROR_QUANTITY_REQUIRED', 'Поле quantity не должно быть пустым');
define('ERROR_PRODUCT_ID_INVALID', 'Поле product-id должно быть целым числом');
define('ERROR_QUANTITY_INVALID', 'Поле quantity должно быть положительным целым числом');

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: /login");
    exit();
} else {

    function validate(): array
    {
        $errors = [];

        if (!isset($_POST['product_id']) || empty($_POST['product_id'])) {
            $errors['product_id'] = ERROR_PRODUCT_ID_REQUIRED;
        } elseif (!ctype_digit($_POST['product_id'])) {
            $errors['product_id'] = ERROR_PRODUCT_ID_INVALID;
        }

        if (!isset($_POST['quantity']) || empty($_POST['quantity'])) {
            $errors['quantity'] = ERROR_QUANTITY_REQUIRED;
        } elseif (!ctype_digit($_POST['quantity']) || $_POST['quantity'] <= 0) {
            $errors['quantity'] = ERROR_QUANTITY_INVALID;
        }

        return $errors;
    }

    $errors = validate();

    if (empty($errors)) {

        $userId = $_SESSION['login'];
        $productId = (int)htmlspecialchars($_POST['product_id'], ENT_QUOTES, 'UTF-8');
        $quantity = (int)htmlspecialchars($_POST['quantity'], ENT_QUOTES, 'UTF-8');

        try {

            $pdo = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'arsik', '0000');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("SELECT * FROM user_products WHERE user_id = :user_id AND product_id = :product_id");
            $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
            $result = $stmt->fetch();

            if ($result) {
                $quantity += $result['quantity'];

                $stmt = $pdo->prepare("UPDATE user_products SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id");
                $stmt->execute(['quantity' => $quantity, 'user_id' => $userId, 'product_id' => $productId]);
            } else {
                $stmt = $pdo->prepare("INSERT INTO user_products (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
                $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'quantity' => $quantity]);
            }

        } catch (PDOException $e) {
            echo "Ошибка при сохранении данных: " . $e->getMessage();
        }
    }
}

require_once './get_add_product.php';