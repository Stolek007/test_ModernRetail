
<?php

// Подключаемся к БД
$mysql = new mysqli('localhost', 'root', 'root', 'modern_retail'); // mysqli потому что с PDO не работает


// Обрабатываем ajax запрос и возвращаем результат
if(isset($_POST['selectVal']))
{
    $filter_id = $_POST['selectVal'];
    $result = $mysql->query("SELECT * FROM `address` WHERE `user_id` = '$filter_id'");
    $res = $result->fetch_assoc();
    echo json_encode($res);
}
else
{
    $result = $mysql->query("SELECT * FROM `address`");
    $res = $result->fetch_assoc();
    echo json_encode($res);
}