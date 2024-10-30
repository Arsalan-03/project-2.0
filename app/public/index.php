<?php

require_once './../Core/Autoload.php';

use Controller\FavoritesController;
use Controller\OrderController;
use Controller\ProductController;
use Controller\UserController;
use Core\Autoload;
use Core\src;

$rootPath = dirname(__DIR__);
Autoload::registrate($rootPath);

// Создаем экземпляр класса и запускаем приложение
$app = new src();

$app->get('/registrate', UserController::class, 'getRegistrateForm');
$app->get('/login', UserController::class, 'getLoginForm');
$app->get('/main', ProductController::class, 'getMain');
//$app->get('/add-product', ProductController::class, 'getAddProductForm');
$app->get('order', OrderController::class, 'getOrderForm');
$app->get('/favorites', FavoritesController::class, 'getFavoritesForm');
$app->get('/test', ProductController::class, 'test');

$app->post('registrate', UserController::class, 'registrate');
$app->post('login', UserController::class, 'login');
$app->post('/add-product', ProductController::class, 'addProduct');
$app->post('/order', OrderController::class, 'order');

$app->run();

