<?php

namespace Core;

use Controller\OrderController;
use Controller\ProductController;
use Controller\UserController;

class src
{
    private array $routes = [
        '/login' => [
            'GET' => [
                'class' => UserController::class,
                'method' => 'getLoginForm',
            ],
            'POST' => [
                'class' => UserController::class,
                'method' => 'login',
            ],
        ],
        '/registrate' => [
            'GET' => [
                'class' => UserController::class,
                'method' => 'getRegistrateForm',
            ],
            'POST' => [
                'class' => UserController::class,
                'method' => 'registrate',
            ],
        ],
        '/main' => [
            'GET' => [
                'class' => ProductController::class,
                'method' => 'getMain',
            ],
        ],
        '/add-product' => [
            'GET' => [
                'class' => ProductController::class,
                'method' => 'getAddProductForm',
            ],
            'POST' => [
                'class' => ProductController::class,
                'method' => 'addProduct',
            ],
        ],
        '/order' => [
            'GET' => [
                'class' => OrderController::class,
                'method' => 'getOrderForm',
            ],
            'POST' => [
                'class' => OrderController::class,
                'method' => 'order',
            ],
        ],
    ];

    public function run()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // Проверяем, существует ли маршрут для запрошенного URI и метода
        if (isset($this->routes[$requestUri][$requestMethod])) {
            $route = $this->routes[$requestUri][$requestMethod];
            $className = $route['class'];
            $methodName = $route['method'];

            // Создаем экземпляр класса и вызываем метод
            $controller = new $className();
            $controller->$methodName();
        } else {
            // Если маршрут не найден, возвращаем ошибку 404
            require_once './../View/404.php';
        }
    }
}

