<?php
if (isset($_SESSION['login'])) {
    $login = mysqli_real_escape_string($link, $_SESSION['login']);
    $userchat_page = basename($_SERVER['PHP_SELF']) === 'userchat.php';

    // Проверка статуса пользователя
    $user_query = mysqli_query($link, "SELECT status FROM users WHERE login='$login'");
    if (mysqli_num_rows($user_query) > 0) {
        $user_row = mysqli_fetch_assoc($user_query);
        $user_status = $user_row['status'];

        // Проверка статуса пользователя
        if (in_array($user_status, [1, 2, 3]) && !$userchat_page) {
            // Проверка новых записей в таблице help
            $new_info_query = mysqli_query($link, "SELECT COUNT(*) AS new_info_count FROM help WHERE id > (SELECT MAX(id) FROM help WHERE user_id = '$login') AND user_id = '$login' AND tema IS NOT NULL");
            if (mysqli_num_rows($new_info_query) > 0) {
                $new_info_row = mysqli_fetch_assoc($new_info_query);
                $new_info_count = $new_info_row['new_info_count'];
                if ($new_info_count > 0) {
                    echo "<div style='position: fixed; top: 20px; right: 20px; background-color: #fff; border: 1px solid #000; padding: 10px; z-index: 9999;'>Новые обращения пользователей</div>";
                } else {
                    unset($_SESSION['answered']);
                }
            } else {
                unset($_SESSION['answered']);
            }
        }
    }
}
?>
