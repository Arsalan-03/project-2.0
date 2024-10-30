<?php

namespace Core;

class Autoload
{
    public static function registrate(string $rootPath)
    {
        $autoload = function (string $className) use ($rootPath) {

            $path = str_replace('\\', DIRECTORY_SEPARATOR, $className);

            $path = $rootPath . '/' . $path . '.php';

            if (file_exists($path)) {
                require_once $path;
                return true;
            }
            return false;
        };

        spl_autoload_register($autoload);
    }
}
