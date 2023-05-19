<?php
// подключение к бд
require_once 'login.php'; 
$user_id = mysqli_real_escape_string($link, $_GET['user_id']);
$tema = mysqli_real_escape_string($link, $_GET['tema']);
$help_query = mysqli_query($link, "SELECT helpa FROM help WHERE user_id = '$user_id' AND id = '$tema' LIMIT 1");

if ($help_query) {
    if (mysqli_num_rows($help_query) > 0) {
        $help_row = mysqli_fetch_assoc($help_query);
        echo '<label>Обращение пользвотеля:</label><textarea readonly>' . $help_row['helpa'] . '</textarea>';
    } else {
        echo "<br><p>Обращение пользователя не найдено.</p>";
    }
} else {
    echo "<br><p>Ошибка при получении обращения пользователя: " . mysqli_error($link) . "</p>";
}
?>
