<?php

// Подключаемся к БД
require '../db/db.php';

// Принимаем данные
$city = filter_var(trim($_POST['city']), FILTER_SANITIZE_STRING);
$postcode = filter_var(trim($_POST['postcode']), FILTER_SANITIZE_STRING);
$region = filter_var(trim($_POST['region']), FILTER_SANITIZE_STRING);
$street = filter_var(trim($_POST['street']), FILTER_SANITIZE_STRING);

// Заносим в таблицу в зависимости от данных
if (mb_strlen($city) != 0) {
    $result_city = $mysql->prepare("UPDATE `address` SET `city` = '$city'");
    $result_city->execute();
}

if (mb_strlen($postcode) != 0) {
    $result_postcode = $mysql->prepare("UPDATE `address` SET `postcode` = '$postcode'");
    $result_postcode->execute();
}

if (mb_strlen($region) != 0) {
    $result_region = $mysql->prepare("UPDATE `address` SET `region` = '$region'");
    $result_region->execute();
}

if (mb_strlen($street) != 0) {
    $result_street = $mysql->prepare("UPDATE `address` SET `street` = '$street'");
    $result_street->execute();
}

header('Location: ../index.php'); // Перенаправляем на главную страницу