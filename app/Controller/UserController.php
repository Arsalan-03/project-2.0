<?php

namespace Controller;

use Model\User;
use PDOException;

// Константы для сообщений об ошибках
define('ERROR_NAME_REQUIRED', 'Поле name не должно быть пустым');
define('ERROR_NAME_SHORT', 'Слишком короткое имя');
define('ERROR_NAME_LONG', 'Слишком длинное имя');
define('ERROR_NAME_INVALID', 'Имя может содержать только буквы и пробелы.');
define('ERROR_EMAIL_REQUIRED', 'Заполните поле email');
define('ERROR_EMAIL_INVALID', 'Некорректно введён email');
define('ERROR_EMAIL_SHORT', 'Email слишком короткий');
define('ERROR_PASSWORD_REQUIRED', 'Заполните поле password');
define('ERROR_PASSWORD_SHORT', 'Password слишком короткий');
define('ERROR_PASSWORD_REPEAT_REQUIRED', 'Заполните поле повторного ввода пароля');
define('ERROR_PASSWORDS_MISMATCH', 'Пароли не совпадают');
define('ERROR_LOGIN_REQUIRED', 'Поле name не должно быть пустым');
define('ERROR_LOGIN_USERS', 'Неверный логин или пароль');

class UserController
{

    public function getRegistrateForm(): void
    {
        require_once './../View/registrate.php';
    }

    public function registrate(): void
    {
        $errors = $this->validateRegistrate();

        if (empty($errors)) {
            $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
            $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
            $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

            try {
                // Хеширование пароля
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $create = new User();
                $create->create($name, $email, $hashedPassword);

                header("Location: /login");

            } catch (PDOException $e) {
                echo "Ошибка при сохранении данных: " . $e->getMessage();
            }
        }
        require_once './../View/registrate.php';
        exit();
    }

    function validateRegistrate(): array
    {
        $errors = [];

        // Валидация на name
        if (isset($_POST['name'])) {
            $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
            if (empty($name)) {
                $errors['name'] = ERROR_NAME_REQUIRED;
            } elseif (strlen($name) < 2) {
                $errors['name'] = ERROR_NAME_SHORT;
            } elseif (strlen($name) > 30) {
                $errors['name'] = ERROR_NAME_LONG;
            } elseif (!preg_match("/^[a-zA-Zа-яА-Я ]+$/u", $name)) {
                $errors['name'] = ERROR_NAME_INVALID;
            }
        } else {
            $errors['name'] = ERROR_NAME_REQUIRED;
        }

        // Валидация на email
        if (isset($_POST['email'])) {
            $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
            if (empty($email)) {
                $errors['email'] = ERROR_EMAIL_REQUIRED;
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = ERROR_EMAIL_INVALID;
            } elseif (strlen($email) < 5) {
                $errors['email'] = ERROR_EMAIL_SHORT;
            }
        } else {
            $errors['email'] = ERROR_EMAIL_REQUIRED;
        }

        // Проверка пароля
        if (isset($_POST['password'])) {
            $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
            if (empty($password)) {
                $errors['password'] = ERROR_PASSWORD_REQUIRED;
            } elseif (strlen($password) < 6) {
                $errors['password'] = ERROR_PASSWORD_SHORT;
            }
        } else {
            $errors['password'] = ERROR_PASSWORD_REQUIRED;
        }

        // Проверка повторного ввода пароля
        if (isset($_POST['password-repeat'])) {
            $pswRepeat = htmlspecialchars($_POST['password-repeat'], ENT_QUOTES, 'UTF-8');
            if (empty($pswRepeat)) {
                $errors['password-repeat'] = ERROR_PASSWORD_REPEAT_REQUIRED;
            } elseif (isset($password) && $password !== $pswRepeat) {
                $errors['password-repeat'] = ERROR_PASSWORDS_MISMATCH;
            }
        } else {
            $errors['password-repeat'] = ERROR_PASSWORD_REPEAT_REQUIRED;
        }
        return $errors;
    }

    public function getLoginForm()
    {
        require_once './../View/login.php';
    }

    public function login()
    {
        $errors = $this->validateLogin();

        // Если ошибок нет, продолжаем аутентификацию
        if (empty($errors)) {
            $login = $_POST['login'];
            $password = $_POST['password'];

            try {
                $data = new User();
                $user = $data->getUserByEmail($login);

                if ($user === false) {
                    $errors['login'] = ERROR_LOGIN_USERS;
                } else {
                    $passwordFromDb = $user['password'];

                    if (!password_verify($password, $passwordFromDb)) {
                        $errors['login'] = ERROR_LOGIN_USERS;
                    } else {
                        session_start();
                        $_SESSION['login'] = $user['id'];
                        header("Location: /main");
                        exit();
                    }
                }
            } catch (PDOException $e) {
                // Логирование ошибки
                error_log("Ошибка при аутентификации: " . $e->getMessage());
                $errors['database'] = "Произошла ошибка при аутентификации. Пожалуйста, попробуйте позже.";
            }
        }

        // Передаем ошибки в представление
        require_once './../View/login.php';
        exit();
    }

    public function validateLogin(): array
    {
        $errors = [];

        // Валидация поля login
        if (isset($_POST['login'])) {
            $login = htmlspecialchars($_POST['login'], ENT_QUOTES, 'UTF-8');
            if (empty($login)) {
                $errors['login'] = ERROR_LOGIN_REQUIRED;
            }
        } else {
            $errors['login'] = ERROR_LOGIN_REQUIRED;
        }

        // Валидация поля password
        if (isset($_POST['password'])) {
            $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
            if (empty($password)) {
                $errors['password'] = ERROR_PASSWORD_REQUIRED;
            }
        } else {
            $errors['password'] = ERROR_PASSWORD_REQUIRED;
        }

        return $errors;
    }
}