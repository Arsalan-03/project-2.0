<?php

namespace Controller;

use Model\Product;
use Model\UserProduct;
use PDOException;

define('ERROR_PRODUCT_ID_REQUIRED', 'Поле product-id не должно быть пустым');
define('ERROR_QUANTITY_REQUIRED', 'Поле quantity не должно быть пустым');
define('ERROR_CHECK_REQUIRED', 'Введите корректный ID товара');

require_once './../Model/Product.php';
require_once './../Model/UserProduct.php';


class ProductController
{
    public function getMain(): void
    {
        session_start();

        if (!isset($_SESSION['login'])) {
            header("location: /login");
        } else {
            $userId = $_SESSION['login'];

            $data = new Product();
            $products = $data->getProducts();

            $cart = new UserProduct();
            $userProducts = $cart->getCart($userId);

            require_once './../View/main.php';
        }
    }

    public function getAddProductForm(): void
    {
        session_start();

        if (!isset($_SESSION['login'])) {
            header("Location: /login");
            exit();
        } else {
            require_once './../View/addProduct.php';
        }
    }

    public function addProduct()
    {
        session_start();

        if (!isset($_SESSION['login'])) {
            // Handle user not logged in
            return; // Or redirect to login page
        }

        $errors = $this->validateAddProduct();

        if (empty($errors)) {
            $userId = $_SESSION['login'];
            $productId = $_POST['product_id'];
            $quantity = (int)$_POST['quantity'];

            try {
                $data = new UserProduct();
                $checkProductId = $data->checkIdProduct($productId);

                if ($checkProductId === false) {
                    $errors['product_id'] = ERROR_CHECK_REQUIRED;
                } else {
                    $checkProductInCart = $data->checkProductInCart($userId, $productId);

                    if ($checkProductInCart) {
                        // Update quantity if product is already in cart
                        $newAmount = $quantity + $checkProductInCart['quantity'];
                        $data->updateProductQuantity($newAmount, $productId, $userId);
                    } else {
                        // Add new product to cart
                        $data->addProductToCart($userId, $productId, $quantity);
                    }
                }
            } catch (PDOException $e) {
                error_log("Ошибка при добавлении продукта: " . $e->getMessage());
                $errors['database'] = "Произошла ошибка при добавлении продукта. Пожалуйста, попробуйте позже.";
            }
        }

        // Передаем ошибки в представление
        print_r($errors);
        require_once './../View/addProduct.php';
    }

    public function validateAddProduct(): array
    {
        $errors = [];

        // Валидация поля product_id
        if (isset($_POST['product_id'])) {
            $productId = $_POST['product_id'];
            if (empty($productId)) {
                $errors['product_id'] = ERROR_PRODUCT_ID_REQUIRED;
            }
        } else {
            $errors['product_id'] = ERROR_PRODUCT_ID_REQUIRED;
        }

        // Валидация поля quantity
        if (isset($_POST['quantity'])) {
            $quantity = $_POST['quantity'];
            if (empty($quantity)) {
                $errors['quantity'] = ERROR_QUANTITY_REQUIRED;
            }
        } else {
            $errors['quantity'] = ERROR_QUANTITY_REQUIRED;
        }

        return $errors;
    }
}