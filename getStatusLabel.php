<?
if (isset($_SESSION['status']) && $_SESSION['status'] == 1) {
// Функция для получения метки статуса
function getStatusLabel($status) {
    // Ваш код для определения метки статуса
    // Например:
    switch ($status) {
        case '2':
            return 'Статус Редактор';
        case '3':
            return 'Статус Поддержка';
        case '10':
            return 'Статус обычный';
        default:
            return 'Неизвестный статус';
    }
}
}else{
     echo '<script>window.location.href = "main.php";</script>';
     exit;
}
?>