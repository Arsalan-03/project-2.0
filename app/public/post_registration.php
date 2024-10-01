<?php
$errors = [];

$name = $_POST['name'] ?? '';
if (empty($name)) {
    $errors[] = "Заполните поле name";
} elseif (strlen($name) < 2) {
    $errors[] = "Слишком короткое имя";
} elseif (strlen($name) > 30) {
    $errors[] = "Слишком длинное имя";
} elseif (!preg_match("/^[a-zA-Zа-яА-Я ]+$/u", $name)) {
    $errors[] = "Имя может содержать только буквы и пробелы.";
}

$email = $_POST['email'] ?? '';
if (empty($email)) {
    $errors[] = "Заполните поле email";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Некорректно введён email";
} elseif (strlen($email) < 5) {
    $errors[] = "Email слишком короткий";
} elseif (strlen($email) > 255) {
    $errors[] = "Email слишком длинный";
}

$password = $_POST['password'] ?? '';
$pswRepeat = $_POST['password-repeat'] ?? '';

if (empty($password)) {
    $errors[] = "Заполните поле password";
} elseif (strlen($password) < 6) {
    $errors[] = "Password слишком короткий";
}

if (empty($pswRepeat)) {
    $errors[] = "Заполните поле повторного ввода пароля";
} elseif ($password !== $pswRepeat) {
    $errors[] = "Пароли не совпадают";
}

if (empty($errors)) {
    $pdo = new PDO('pgsql:host=db;port=5432;dbname=postgres', 'arsik', '0000');
    //вставляем данные в таблицу
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
    $stmt->execute(['name' => $name, 'email' => $email, 'password' => password_hash($password, PASSWORD_DEFAULT)]);
    //достаём данные из таблицы
}

//$result = $pdo->query("SELECT * FROM users");
//print_r($result->fetch(PDO::FETCH_ASSOC));

$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$stmt->execute(['email' => $email]);
print_r($stmt->fetch());