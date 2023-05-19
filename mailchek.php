<?php
if (isset($_SESSION['login'])) {
    $login = mysqli_real_escape_string($link, $_SESSION['login']);
    $userchat_page = basename($_SERVER['PHP_SELF']) === 'userchat.php';

    if (!$userchat_page) {
        $chat_query = mysqli_query($link, "SELECT user_id, answer, last_notification_time FROM chat WHERE user_id='$login'");
        if (mysqli_num_rows($chat_query) > 0) {
            $chat_row = mysqli_fetch_assoc($chat_query);
            $last_notification_time = $chat_row['last_notification_time'];

            if ($last_notification_time === null && !isset($_SESSION['answered'])) {
                echo "<div style='position: fixed; top: 20px; right: 20px; background-color: #fff; border: 1px solid #000; padding: 10px; z-index: 9999;'>Вам ответили! Зайдите в личные сообщения.</div>";
                $_SESSION['answered'] = true;

                // Обновляем поле last_notification_time после вывода уведомления
                mysqli_query($link, "UPDATE chat SET last_notification_time = NOW() WHERE user_id='$login'");
            }
        } else {
            // Если нет записей в чате, сбрасываем сессионную переменную
            unset($_SESSION['answered']);
        }
    }
}
?>
