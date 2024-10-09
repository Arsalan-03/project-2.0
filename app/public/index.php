<?php

use Controller\ProductController;
use Controller\UserController;

require_once './../Controller/UserController.php';
require_once './../Controller/ProductController.php';


$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestUri === '/login') {
    if ($requestMethod === 'GET') {
        $userController = new UserController();
        $userController->getLoginForm();
    } elseif ($requestMethod === 'POST') {
        $userController = new UserController();
        $userController->login();
    } else {
        echo "$requestMethod не поддерживается адресом $requestUri";
    }
} elseif ($requestUri === '/registrate') {
    if ($requestMethod === 'GET') {
        $userController = new UserController();
        $userController->getRegistrateForm();
    } elseif ($requestMethod === 'POST') {
        $userController = new UserController();
        $userController->registrate();
    } else {
        echo "$requestMethod не поддерживается адресом $requestUri";
    }
} elseif ($requestUri === '/main') {
    if ($requestMethod === 'GET') {
        $productController = new ProductController();
        $productController->getMain();
    } else {
        echo "$requestMethod не поддерживается адресом $requestUri";
    }
} elseif ($requestUri === '/add-product') {
    if ($requestMethod === 'GET') {
        $productController = new ProductController();
        $productController->getAddProductForm();
    } elseif ($requestMethod === 'POST') {
        $productController = new ProductController();
        $productController->addProduct();
    } else {
        echo "$requestMethod не поддерживается адресом $requestUri";
    }
} else {
    http_response_code(404);
    require_once './404.php';
}