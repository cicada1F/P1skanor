<?php
// подключение меню
require_once 'menu.php';
?>
    <ul class="nav">
<?php
// подключение к БД
require_once 'login.php';

// Проверка авторизации пользователя
if (!isset($_SESSION['login'])) {
    echo '<script>window.location.href = "main.php";</script>';
    exit; // Завершение выполнения скрипта
}

// Получение логина текущей сессии
$login = mysqli_real_escape_string($link, $_SESSION['login']);

// Получение всех записей из таблицы chat, относящихся к текущему пользователю, с сортировкой по теме (tema)
$chat_query = mysqli_query($link, "SELECT tema, answer, facelog FROM chat WHERE user_id='$login' ORDER BY tema");

// Обход всех записей из таблицы chat
while ($chat_row = mysqli_fetch_assoc($chat_query)) {
    $tema = $chat_row['tema'];
    $answer = $chat_row['answer'];
    $facelog = $chat_row['facelog'];

    // Получаем название темы из таблицы help по её id
    $help_query = mysqli_query($link, "SELECT tema FROM help WHERE id='$tema'");

    if (mysqli_num_rows($help_query) > 0) {
        $help_row = mysqli_fetch_assoc($help_query);
        $help_tema = $help_row['tema'];

        echo '<div class="bord">';
        echo "<br><label for='tema' readonly>Ваша тема обращения:</label><br>";
        echo "<input type='text' id='tema' name='tema' value='$help_tema' readonly><br>";
        echo "<label for='answer' readonly>На ваше обращение ответил —<p>$facelog</p></label><br>";
        echo "<textarea id='answer' name='answer' rows='4' cols='50' readonly>$answer</textarea><br>";
        echo '</div>';
    }
}

// Если записей в таблице chat нет, то выводим соответствующее сообщение
if (mysqli_num_rows($chat_query) == 0) {
    echo "У вас нет обращений";
}


?>