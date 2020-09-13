<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Главная страница</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>
<body>

<?php require 'layouts/layout.php'; ?> <!-- Подключаем шаблонник(табы) -->

<?php require 'db/db.php'; ?>
<?php $result = $mysql->prepare('SELECT * FROM `users` ORDER BY created_at'); // Выводим всех юзеров
$result->execute();
$allUsers = $result->fetchAll();
?>

<?php foreach($allUsers as $user): ?>
    <form action="php/addresses.php" method="post">
        <input type="hidden" name="user_id" value="<?=$user['id']; ?>">
        <?php $_SESSION['is_id'] = $user['id']; ?>
        <a href="#"><td><a href="#"><input type="submit" name="button" value="<?=$user['first_name']; ?>"></a></td></a>
    </form>
<?php endforeach; ?>
</body>
</html>
