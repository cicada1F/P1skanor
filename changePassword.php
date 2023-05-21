<?
if (isset($_SESSION['status']) && $_SESSION['status'] == 1) {
// Функция для изменения пароля пользователя
function changePassword($userId, $password)
{
    global $link;

    $hashedPassword = md5($password);
    mysqli_query($link, "UPDATE users SET password='$hashedPassword' WHERE id='$userId'");

    echo 'Пароль пользователя успешно обновлен.';
}
}else{
     echo '<script>window.location.href = "main.php";</script>';
     exit;
}
?>