<?php
// Константы для сообщений об ошибках
define('ERROR_NAME_REQUIRED', 'Поле name не должно быть пустым');
define('ERROR_NAME_SHORT', 'Слишком короткое имя');
define('ERROR_NAME_LONG', 'Слишком длинное имя');
define('ERROR_NAME_INVALID', 'Имя может содержать только буквы и пробелы.');
define('ERROR_EMAIL_REQUIRED', 'Заполните поле email');
define('ERROR_EMAIL_INVALID', 'Некорректно введён email');
define('ERROR_EMAIL_SHORT', 'Email слишком короткий');
define('ERROR_EMAIL_LONG', 'Email слишком длинный');
define('ERROR_PASSWORD_REQUIRED', 'Заполните поле password');
define('ERROR_PASSWORD_SHORT', 'Password слишком короткий');
define('ERROR_PASSWORD_REPEAT_REQUIRED', 'Заполните поле повторного ввода пароля');
define('ERROR_PASSWORDS_MISMATCH', 'Пароли не совпадают');

function validate(): array
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
        } elseif (strlen($email) > 255) {
            $errors['email'] = ERROR_EMAIL_LONG;
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

$errors = validate();

if (empty($errors)) {
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

    try {
        $pdo = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'arsik', '0000');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //позволяет использовать механизм исключений для обработки ошибок

        // Хеширование пароля
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Вставляем данные в таблицу
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $stmt->execute(['name' => $name, 'email' => $email, 'password' => $hashedPassword]);

        header("Location: /login");

    } catch (PDOException $e) {
        echo "Ошибка при сохранении данных: " . $e->getMessage();
    }
}
    require_once './get_registration.php';
    exit();




