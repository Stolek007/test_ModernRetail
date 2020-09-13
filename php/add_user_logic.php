<?php

// Подключаемся к БД
require '../db/db.php';

// Принимаем данные
$first_name = filter_var(trim($_POST['first_name']), FILTER_SANITIZE_STRING);
$last_name = filter_var(trim($_POST['last_name']), FILTER_SANITIZE_STRING);
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$user_type = trim($_POST['user_type']);
$password = $_POST['password'];

// Создаем массив ошибок
$errors = [];

// Проходим валидацию
if(mb_strlen($first_name) == 0) {
    array_push($errors, 'Пустое поле "Имя"');
}

if (mb_strlen($last_name) == 0) {
    array_push($errors, 'Пустое поле "Отчество"');
}

if (mb_strlen($email) == 0) {
    array_push($errors, 'Пустое поле "E-mail"');
}

if (mb_strlen($user_type) == 0) {
    array_push($errors, 'Пустое поле "Тип"');
}

if (mb_strlen($password) == 0) {
    array_push ($errors, 'Пустое поле "Пароль"');
}

if (!empty($errors)) {
    for ($i = 0; $i < count($errors); $i++) {
        echo $errors[$i];
        exit();
    }
}

else if (empty($errors)) {
    // Проверяем есть ли уже такой пользователь

    $result = $mysql->prepare("SELECT * FROM `users` WHERE `email` = '$email'");
    $result->execute();
    $test_result = $result->fetchAll();

    if (!empty($test_result)) {
        echo "Пользователь с таким e-mail уже существует";
        exit();
    }

    // Если пользователя нету, то регистрируем
    $date = date('Y-m-d H:i:s'); // Считываем дату
    $password = md5($password); // Хешируем пароль
    $res = $mysql->prepare("INSERT INTO `users` (`first_name`, `last_name`, `email`, `user_type`, `password`, `created_at`) VALUES ('$first_name', '$last_name', '$email', '$user_type', '$password', '$date')");
    $res->execute();
    $user_result = $mysql->prepare("SELECT * FROM `users` WHERE `email` = '$email'");
    $user_result->execute();
    $user_fetch = $user_result->fetchAll();
    foreach ($user_fetch as $user) {}
    $isUser = $user['id'];
    $isAddress = $mysql->prepare("INSERT INTO `address` (`user_id`, `city`, `postcode`, `region`, `street`) VALUES ('$isUser', 'None', 'None', 'None', 'None')");
    $isAddress->execute();
    header ('Location: ../index.php');
}

