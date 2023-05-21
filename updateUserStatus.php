<?php
if (isset($_SESSION['status']) && $_SESSION['status'] == 1) {
// подключение к базе данных
include 'login.php';

function updateUser($userId, $userData) {
    global $link;

    $updateFields = [];
    foreach ($userData as $field => $value) {
        if ($field === 'status') {
            $updateFields[] = "$field = '$value'";
        } else {
            $updateFields[] = "$field = '$value'";
        }
    }

    $updateQuery = "UPDATE users SET " . implode(", ", $updateFields) . " WHERE id = '$userId'";
    mysqli_query($link, $updateQuery);

    // Получаем обновленное значение статуса из базы данных
    $statusQuery = "SELECT status FROM users WHERE id = '$userId'";
    $statusResult = mysqli_query($link, $statusQuery);
    $user['status'] = mysqli_fetch_assoc($statusResult)['status'];
}
}else{
     echo '<script>window.location.href = "main.php";</script>';
     exit;
}

?>
