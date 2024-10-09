<?php

namespace Controller;

use Model\Products;
use Model\UserProducts;
use PDOException;

define('ERROR_PRODUCT_ID_REQUIRED', 'Поле product-id не должно быть пустым');
define('ERROR_QUANTITY_REQUIRED', 'Поле quantity не должно быть пустым');

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
                $productId = htmlspecialchars($_POST['product_id'], ENT_QUOTES, 'UTF-8');
                $quantity = htmlspecialchars($_POST['quantity'], ENT_QUOTES, 'UTF-8');

                try {
                    $data = new UserProducts();
                    $data->addProductCart($userId, $productId, $quantity);
                } catch (PDOException $e) {
                    echo "Ошибка при сохранении данных: " . $e->getMessage();
                }
            }

            require_once './../View/addProduct.php';
    }

    function validateAddProduct(): array
    {
        $errors = [];

        if (isset($_POST['product_id'])) {
            $productId = htmlspecialchars($_POST['product_id'], ENT_QUOTES, 'UTF-8');
        } elseif (empty($productId)) {
            $errors['product-id'] = ERROR_PRODUCT_ID_REQUIRED;
        }

        if (isset($_POST['quantity'])) {
            $quantity = htmlspecialchars($_POST['quantity'], ENT_QUOTES, 'UTF-8');
        } elseif (empty($quantity)) {
            $errors['quantity'] = ERROR_QUANTITY_REQUIRED;
        }
        return $errors;
    }
}