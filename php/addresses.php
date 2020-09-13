<?php

// Подключаем к БД
require '../db/db.php';
$id = $_POST['user_id']; // Принимаем айди

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добавить адрес</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>
<body>
<form action="add_addresses.php" method="post">
    <input type="text" name="city" placeholder="City">
    <input type="text" name="postcode" placeholder="Postcode">
    <input type="text" name="region" placeholder="Region">
    <input type="text" name="street" placeholder="Street">
    <button type="submit" class="btn btn-success">Подтвердить</button>
</form>

<?php

// Принимаем айди пользователя через GET параметр
if (isset($_GET['del'])) {
    $del = $_GET['del'];
    $id = $del;
}

// Принимаем тип
if (isset($_GET['type'])) {
    $type = $_GET['type'];
    if ($type == 'city') {
        $delete = $mysql->prepare("UPDATE `address` SET `city` = 'None' WHERE `user_id` = '$del'");
        $delete->execute();
    } else if ($type == 'postcode') {
        $delete = $mysql->prepare("UPDATE `address` SET `postcode` = 'None' WHERE `user_id` = '$del'");
        $delete->execute();
    } else if ($type == 'region') {
        $delete = $mysql->prepare("UPDATE `address` SET `region` = 'None' WHERE `user_id` = '$del'");
        $delete->execute();
    } else if ($type == 'street') {
        $delete = $mysql->prepare("UPDATE `address` SET `street` = 'None' WHERE `user_id` = '$del'");
        $delete->execute();
    }
}

?>

<?php

// Берем адресса
$result = $mysql->prepare("SELECT * FROM `address` WHERE `user_id` = '$id'");
$result->execute();
$allUsers = $result->fetchAll();


?>

<!-- Таблица с адрессами и возможностью удаления -->
<table>
    <tr>
        <th>Address</th>
        <th>Delete</th>
    </tr>
    <?php $result = ''; ?>
    <?php foreach ($allUsers as $user) {
        $result .= '<tr>';

        $result .= '<td>' . $user['city'] . '</td>';
        $result .= '<td><a href="?del=' . $user['user_id'] . ' &type=city">удалить</a></td>'; // При удалении в GET передаем айди пользователя и тип

        $result .= '</tr>';

        $result .= '<tr>';

        $result .= '<td>' . $user['postcode'] . '</td>';
        $result .= '<td><a href="?del=' . $user['user_id'] . ' &type=postcode">удалить</a></td>';

        $result .= '</tr>';

        $result .= '<tr>';

        $result .= '<td>' . $user['region'] . '</td>';
        $result .= '<td><a href="?del=' . $user['user_id'] . ' &type=region">удалить</a></td>';

        $result .= '</tr>';

        $result .= '<tr>';

        $result .= '<td>' . $user['street'] . '</td>';
        $result .= '<td><a href="?del=' . $user['user_id'] . ' &type=street">удалить</a></td>';

        $result .= '</tr>';

        echo $result;
    }
    ?>
</table>

</body>
</html>


<!--if (isset($_POST['selectVal'])) {
$filter_id = $_POST['selectVal'];
$result = $mysql->query("SELECT * FROM `users` WHERE `id` = '$filter_id'");
$res = $result->fetch_assoc();
echo json_encode($res);
}-->