<!DOCTYPE html>
<html lang="ru" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Заголовок</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js"
            integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

</head>
<body>

<?php require 'layouts/layout.php'; ?>

<!-- подключение к БД -->
<?php require 'db/db.php'; ?>
<?php
$res = $mysql->prepare("SELECT * FROM `users`");
$res->execute();
$result = $res->fetchAll();
?>

<select name="select" id="select">
    <!-- Список со всеми юзерами -->
    <?php foreach ($result as $user): ?>
        <option value="<?= $user['id']; ?>"><? echo $user['first_name'] . "\n" . $user['last_name'] . "\n"; ?></option>
    <?php endforeach; ?>
</select>

<script type="text/javascript">
    // ajax запрос

    $('#select').on("change", function () {
        let val = $('#select').val();
        $('.all-addresses').css('display', 'none'); // Если идет фильтрация -> отключаем все адреса

        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            data: {'selectVal': val},
            success: function (data) {
                let isData = JSON.parse(data);
                $('#p1').text(isData['city'] + "\n" + isData['postcode'] + "\n" + isData['region'] + "\n" + isData['street']);

            }
        })

    });
</script>
<!-- Получаем все адреса -->
<?php $all = $mysql->prepare("SELECT * FROM `address`");
$all->execute();
$allAddresses = $all->fetchAll(); ?>

<?php
// Выводим все адреса

$addresses = '';
foreach ($allAddresses as $address) {
    $addresses .= '<p class="all-addresses">' . "\n" . $address['city'] . "\n" . $address['postcode'] . "\n" . $address['region'] . "\n" . $address['street'] . '</p>';
    echo $addresses;
}

?>

<p id="p1"></p>

</body>
</html>