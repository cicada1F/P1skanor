<?php
// подключение чекера ошибок
error_reporting(E_ALL);
ini_set('display_errors', 1);

// подключение к бд и там же стартуем сессию
require_once 'login.php';

// Получение файла из поля Main
$stmt = $link->prepare("SELECT REG FROM chek WHERE id = ?");
$id = 151; // Идентификатор записи
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($main);
    $stmt->fetch();

    // Установка заголовка для вывода аудио
    header('Content-Type: audio/mpeg');
    header('Content-Disposition: inline; filename="main.mp3"');

    // Вывод содержимого аудиофайла
    echo $main;
} else {
    echo "Файл не найден";
}

$stmt->close();
$link->close();
?>
