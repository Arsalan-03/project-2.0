<?php

use Core\src;

$autoload = function (string $className)
{
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $path = './../' . $path . '.php';

    if (file_exists($path)) {
        require_once $path;
        return true;
    }
    return false;
};

spl_autoload_register($autoload);

// Создаем экземпляр класса и запускаем приложение
$app = new src();
$app->run();

