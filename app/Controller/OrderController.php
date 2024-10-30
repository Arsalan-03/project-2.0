<?php

namespace Controller;

use Model\OrderProduct;
use Model\Order;
use Model\UserProduct;

define('ERROR_PHONE_REQUIRED', 'Поле phone не должно быть пустым');
define('ERROR_PHONE_INVALID', 'Некорректно введён телефон');
define('ERROR_ADDRESS_REQUIRED', 'Поле address не должно быть пустым');
define('ERROR_CITY_REQUIRED', 'Поле city не должно быть пустым');
define('ERROR_COUNTRY_REQUIRED', 'Поле country не должно быть пустым');
define('ERROR_POSTAL_REQUIRED', 'Поле postal не должно быть пустым');

class OrderController
{
    public function getOrderForm(): void
    {
            require_once './../View/order.php';
    }

    public function order(): void
    {
        session_start();

        if (!isset($_SESSION['login'])) {
            header("Location: /login");
        } else {

            $errors = $this->validateOrder();

            if (empty($errors)) {
                $userId = $_SESSION['login'];
                $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
                $phone = htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8');
                $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
                $address = htmlspecialchars($_POST['address'], ENT_QUOTES, 'UTF-8');
                $city = htmlspecialchars($_POST['city'], ENT_QUOTES, 'UTF-8');
                $country = htmlspecialchars($_POST['country'], ENT_QUOTES, 'UTF-8');
                $postal = htmlspecialchars($_POST['postal'], ENT_QUOTES, 'UTF-8');

                $orderModel = new Order();
                $orderId  = $orderModel->addOrder($email, $phone, $name, $address, $city, $country, $postal);
                $orderProductModel = new OrderProduct();
                $orderProductModel->addOrderProduct($userId, $orderId);
                $userProductModel = new UserProduct();
                $userProductModel->deleteProductsInCart($userId);
            }
        }
    }

    public function validateOrder(): array
    {
        $errors = [];

        if (isset($_POST['email'])) {
            $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
        } elseif (empty($email)) {
            $errors['email'] = ERROR_EMAIL_REQUIRED;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = ERROR_EMAIL_INVALID;
        } elseif (strlen($email) <= 5) {
            $errors['email'] = ERROR_EMAIL_SHORT;
        } else {
            $errors['email'] = ERROR_EMAIL_REQUIRED;
        }

        if (isset($_POST['phone'])) {
            $phone = htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8');
        } elseif (empty($phone)) {
            $errors['phone'] = ERROR_PHONE_REQUIRED;
        } elseif (!preg_match('/^[0-9]{10}$/', $phone)) {
            $errors = ERROR_PHONE_INVALID;
        } else {
            $errors['phone'] = ERROR_PHONE_REQUIRED;
        }

        if (isset($_POST['name'])) {
            $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
        } elseif (empty($name)) {
            $errors['name'] = ERROR_NAME_REQUIRED;
        } elseif (strlen($name) <= 5) {
            $errors['name'] = ERROR_NAME_SHORT;
        } else {
            $errors['name'] = ERROR_NAME_REQUIRED;
        }

        if (isset($_POST['address'])) {
            $address = htmlspecialchars($_POST['address'], ENT_QUOTES, 'UTF-8');
        } elseif (empty($address)) {
            $errors['address'] = ERROR_ADDRESS_REQUIRED;
        } else {
            $errors['address'] = ERROR_ADDRESS_REQUIRED;
        }

        if (isset($_POST['city'])) {
            $city = htmlspecialchars($_POST['city'], ENT_QUOTES, 'UTF-8');
        } elseif (empty($city)) {
            $errors['city'] = ERROR_CITY_REQUIRED;
        } else {
            $errors = ERROR_CITY_REQUIRED;
        }

        if (isset($_POST['country'])) {
            $country = htmlspecialchars($_POST['country'], ENT_QUOTES, 'UTF-8');
        } elseif (empty($country)) {
            $errors['country'] = ERROR_COUNTRY_REQUIRED;
        } else {
            $errors = ERROR_COUNTRY_REQUIRED;
        }

        if (isset($_POST['postal'])) {
            $postal = htmlspecialchars($_POST['postal'], ENT_QUOTES, 'UTF-8');
        } elseif (empty($postal)) {
            $errors['postal'] = ERROR_POSTAL_REQUIRED;
        } else {
            $errors = ERROR_POSTAL_REQUIRED;
        }
        return $errors;
    }
}