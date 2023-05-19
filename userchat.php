<?php
session_start();

// Подключение к базе данных
require_once 'login.php';

// Проверяем, если пользователь посетил страницу userchat.php
$userchat_page = basename($_SERVER['PHP_SELF']) === 'userchat.php';

if ($userchat_page && isset($_SESSION['login'])) {
    $login = mysqli_real_escape_string($link, $_SESSION['login']);

    // Обновляем поле last_notification_time только если оно имеет значение NULL
    mysqli_query($link, "UPDATE chat SET last_notification_time = IFNULL(last_notification_time, NOW()) WHERE user_id='$login'");
}
?>

<!DOCTYPE html>
<html>
<body>
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Чат с администрацией</title>
<link rel="stylesheet" href="css/butons.css">
<link rel="stylesheet" href="css/userchat_php/userchat.css">
 	<link rel="stylesheet" href="css/cur/cursor.css">
	<link rel="stylesheet" href="css/text/font.css">
    <link rel="stylesheet" href="css/back/background.css">
</head>
<div class="piska"></div>

<div id="header">
    <div id="wrapper">
        <ul class="nav">
            <?php
            // подключение меню
            require_once 'menu.php';
            ?>
        </ul>
        <ul class="nav">
            <?php
            require_once 'userxchatchek.php';
            ?>

        </ul>
    </div>
</div>
<button type="button" onclick="history.back()"><div class="arrow">Назад</div></button>
<script src="js/textarea.js"></script>
</body>
</html>
