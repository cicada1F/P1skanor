<?php
// имя файла для логирования
$log_file = 'db_logs.txt';

// определение запроса
$query = "SELECT * FROM users";

// попытка выполнить запрос
$result = mysqli_query($link, $query);

// если возникла ошибка, записываем ее в лог
if (!$result) {
    $error_message = mysqli_error($link);
    $timestamp = date('Y-m-d H:i:s');
    $log_message = "$timestamp: $error_message\n";
    file_put_contents($log_file, $log_message, FILE_APPEND | LOCK_EX);
}
?>