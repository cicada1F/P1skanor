<?php

// имя файла для логирования
$log_file = 'db_errors_log.txt';

$host_db = 'localhost';
$login_db = 'admin_uchet';
$pass_db = '12345';
$name_db = 'UCHET';
$link = mysqli_connect($host_db, $login_db, $pass_db, $name_db);

// Проверяем подключение
if (!$link) {
    $error_message = "Ошибка соединения с базой данных: " . mysqli_connect_error();
    error_log($error_message, 3, $log_file);
    die($error_message);
}

// Проверка версий и логирование ошибок
mysqli_query($link, ' SET NAMES utf8') or error_log(mysqli_error($link), 3, $log_file);
mysqli_query($link, "set character set 'utf8'") or error_log(mysqli_error($link), 3, $log_file);
mysqli_query($link, "set session collation_connection = 'utf8_general_ci'") or error_log(mysqli_error($link), 3, $log_file);

// проверка версии php
include 'chek.php';

?>
