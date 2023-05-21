<?
if (isset($_SESSION['status']) && $_SESSION['status'] == 1) {
function deleteAvatar($userId)
{
    global $link;

    $userId = mysqli_real_escape_string($link, $userId);
    $updateQuery = "UPDATE users SET avatars=NULL WHERE id='$userId'";
    if (mysqli_query($link, $updateQuery)) {
        echo 'Аватар успешно удален.';
    } else {
        echo 'Ошибка при удалении аватара: ' . mysqli_error($link);
    }
}
}else{
     echo '<script>window.location.href = "main.php";</script>';
     exit;
}
?>