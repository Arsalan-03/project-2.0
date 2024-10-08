<?php
// Константы для сообщений об ошибках
define('ERROR_LOGIN_REQUIRED', 'Поле name не должно быть пустым');
define('ERROR_PASSWORD_REQUIRED', 'Поле password не должно быть пустым');
define('ERROR_LOGIN_USERS', 'Неверный логин или пароль');

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

// Если ошибок нет, продолжаем аутентификацию
if (empty($errors)) {

    $login = htmlspecialchars($_POST['login'], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

    try {
        $pdo = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'arsik', '0000');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Позволяет использовать механизм исключений для обработки ошибок

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :login");
        $stmt->execute(['login' => $login]);

        $data = $stmt->fetch();

        if ($data === false) {
            $errors['login'] = ERROR_LOGIN_USERS;
        } else {
            $passwordFromDb = $data['password'];

            if (!password_verify($password, $passwordFromDb)) {
                $errors['login'] = ERROR_LOGIN_USERS;
            } else {
                session_start();

                $_SESSION['login'] = $data['id'];
                header("Location: /main");
                exit();
            }
        }
    } catch (PDOException $e) {
        echo "Ошибка при сохранении данных: " . $e->getMessage();
    }
}
    require_once './get_login.php';
    exit();


