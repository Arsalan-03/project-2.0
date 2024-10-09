<?php
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestUri === '/login') {
    if ($requestMethod === 'GET') {
        require_once './get_login.php';
    } elseif ($requestMethod === 'POST') {
        require_once './post_login.php';
    } else {
        echo "$requestMethod не поддерживается адресом $requestUri";
    }
} elseif ($requestUri === '/registrate') {
    if ($requestMethod === 'GET') {
        require_once './get_registration.php';
    } elseif ($requestMethod === 'POST') {
        require_once './post_registration.php';
    } else {
        echo "$requestMethod не поддерживается адресом $requestUri";
    }
} elseif ($requestUri === '/main') {
    if ($requestMethod === 'GET') {
        require_once './main.php';
    } else {
        echo "$requestMethod не поддерживается адресом $requestUri";
    }
} elseif ($requestUri === '/add-product') {
    if ($requestMethod === 'GET') {
        require_once './get_add_product.php';
    } elseif ($requestMethod === 'POST') {
        require_once './post_add_product.php';
    } else {
        echo "$requestMethod не поддерживается адресом $requestUri";
    }
} else {
    http_response_code(404);
    require_once './404.php';
}