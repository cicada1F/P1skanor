<?php
function deleteAvatar($login) {
    // подключаемся к базе данных
    include 'login.php';

    // получаем текущую аватарку пользователя
    $query = "SELECT avatars FROM users WHERE login = '$login'";
    $result = mysqli_query($link, $query);
    if (!$result) die("Ошибка выполнения запроса");
    if (mysqli_num_rows($result) == 0) {
        mysqli_close($link);
        return; // пользователь не найден
    }
    $row = mysqli_fetch_assoc($result);
    $avatar = $row['avatars'];

    // проверяем, есть ли аватарка у пользователя
    if ($avatar === NULL) {
        mysqli_close($link);
        echo "<script>alert('У вас и так нет аватара.');</script>";
        return;
    }

    // удаляем аватарку из базы данных
    $query = "UPDATE users SET avatars = NULL WHERE login = '$login'";
    $result = mysqli_query($link, $query);
    if (!$result) die("Ошибка выполнения запроса");

    mysqli_close($link);

    // выводим сообщение об удалении аватарки
    echo "<script>alert('Ваша фотография успешно удалена.');</script>";
}

// проверяем, была ли отправлена форма
if (isset($_POST['delete_avatar'])) {
    // получаем логин пользователя из сессии
    $login = $_SESSION['login'];

    // вызываем функцию удаления аватарки
    deleteAvatar($login);
}




?>


