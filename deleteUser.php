<?
if (isset($_SESSION['status']) && $_SESSION['status'] == 1) {
function deleteUser($userId)
{
    global $link;

    $userId = mysqli_real_escape_string($link, $userId);
    $deleteQuery = "DELETE FROM users WHERE id='$userId'";
    if (mysqli_query($link, $deleteQuery)) {
        echo 'Пользователь успешно удален.';
    } else {
        echo 'Ошибка при удалении пользователя: ' . mysqli_error($link);
    }
}
}else{
     echo '<script>window.location.href = "main.php";</script>';
     exit;
}
?>