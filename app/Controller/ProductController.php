<?php

namespace Controller;

use Model\Products;
use Model\UserProducts;
use PDOException;

define('ERROR_PRODUCT_ID_REQUIRED', 'Поле product-id не должно быть пустым');
define('ERROR_QUANTITY_REQUIRED', 'Поле quantity не должно быть пустым');
define('ERROR_CHECK_REQUIRED', 'Введите корректный ID товара');

require_once './../Model/Products.php';
require_once './../Model/UserProducts.php';


class ProductController
{
    public function getMain(): void
    {
        session_start();

        if (!isset($_SESSION['login'])) {
            header("location: /login");
            exit();
        } else {
            $userId = $_SESSION['login'];

            $data = new Products();
            $products = $data->getProducts();

            $cart = new UserProducts();
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
        $errors = $this->validateAddProduct();

        if (empty($errors)) {
            session_start();
            $userId = $_SESSION['login'];
            $productId = $_POST['product_id'];
            $quantity = $_POST['quantity'];

            try {
                $data = new UserProducts();
                $checkProductId = $data->checkIdProduct($productId);

                if ($checkProductId === false) {
                    $errors['product_id'] = ERROR_CHECK_REQUIRED;
                } else {
                    $checkProductInCart = $data->checkProductInCart($userId, $productId);

                    if ($checkProductInCart === false) {
                        $data->addProductCart($userId, $productId, $quantity);
                    } else {
                        $newAmount = $quantity + $checkProductInCart['quantity'];
                        $data->updateProductQuantity($productId, $userId, $newAmount);
                    }
                }
            } catch (PDOException $e) {
                // Логирование ошибки
                error_log("Ошибка при добавлении продукта: " . $e->getMessage());
                $errors['database'] = "Произошла ошибка при добавлении продукта. Пожалуйста, попробуйте позже.";
            }
        }

        // Передаем ошибки в представление
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