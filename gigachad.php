<?php
session_start();
// подключение к базе данных
include 'login.php';

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/edit_users/edit_users.css">
  <link rel="stylesheet" href="css/text/font.css">
  <link rel="stylesheet" href="css/back/background.css">
  <link rel="stylesheet" href="css/butons.css">
    <title>Пользователи</title>
</head>
<body>
 <div class="piska"></div>
 <div id="header">
 <h1>Управление пользователями</h1>
  <ul class="nav">
 <?
 // меню
include 'menu.php';
if (isset($_SESSION['status']) && $_SESSION['status'] == 1) {

// Функция для обновления информации о пользователе
include 'updateUserStatus.php';
// Функция для получения метки статуса
include 'getStatusLabel.php';

// Функция для удаления пользователя
include 'deleteUser.php';

// Функция для удаления аватара пользователя
include 'deleteAvatar.php';

// Функция для изменения пароля пользователя
include 'changePassword.php';

// Функция для получения всех пользователей из базы данных
include 'p.php';

// Получение всех пользователей из базы данных
$users = getUsers();


// Обработка POST-запроса для обновления информации о пользователе
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $userId = isset($_POST['userId']) ? $_POST['userId'] : '';
        if (!empty($userId)) {
            deleteUser($userId);
        }
    } else if (isset($_POST['deleteAvatar'])) {
        $userId = isset($_POST['userId']) ? $_POST['userId'] : '';
        if (!empty($userId)) {
            deleteAvatar($userId);
        }
    } else if (isset($_POST['saveUser'])) {
        $userId = isset($_POST['userId']) ? $_POST['userId'] : '';
        $status = isset($_POST['status']) ? $_POST['status'] : '';

        if (!empty($userId) && !empty($status)) {
            updateUser($userId, ['status' => $status]);
        }
    } else if (isset($_POST['changePassword'])) {
        $userId = isset($_POST['userId']) ? $_POST['userId'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        if (!empty($userId) && !empty($password)) {
            changePassword($userId, $password);
        }
    }
}

// Вывод аватаров всех пользователей из базы данных
function getAvatarImage($avatar)
{
    return "data:image/jpeg;base64," . base64_encode($avatar);
}
}
else{
     echo '<script>window.location.href = "main.php";</script>';
     exit;
}
 ?>

 </ul>
 </div>
 <div id="container">
    
    <table border="1" class="data_tbl">
        <thead>
            <tr>
                <th>Имя пользователя</th>
                <th>Статус</th>
                <th>Пароль</th>
                <th>Аватар</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user['login'] ?></td>
                    <td>
                        <div id="status">
                           <?
                                 // Получение статуса конкретного пользователя
                                    $userId = $user['id'];
                                    $sql = "SELECT status FROM users WHERE id = $userId";
                                    $result = mysqli_query($link, $sql);

                                    if ($result && mysqli_num_rows($result) > 0) {
                                        $row = mysqli_fetch_assoc($result);
                                        $status = $row["status"];

                                        // Преобразование числового значения статуса в текстовое описание
                                        $statusText = '';
                                        switch ($status) {
                                            case 1:
                                                $statusText = 'Админ';
                                                break;
                                            case 2:
                                                $statusText = 'Редактор';
                                                break;
                                            case 3:
                                                $statusText = 'Поддержка';
                                                break;
                                            default:
                                                $statusText = 'Обычный пользователь';
                                                break;
                                        }

                                        echo "Текущий статус пользователя: " . $statusText . "<br>";
                                    } else {
                                        echo "Нет доступных данных.";
                                    }
                            ?>

                          
                        </div>
                        <form method="POST">
                            <input type="hidden" name="userId" value="<?= $user['id'] ?>">
                            <select name="status" required>
                                <option value="" disabled selected hidden>Выберите статус</option>
                                <option value="2" <?= $user['status'] === '2' ? 'selected' : '' ?>>Статус Редактор</option>
                                <option value="3" <?= $user['status'] === '3' ? 'selected' : '' ?>>Статус Поддержка</option>
                                <option value="10" <?= $user['status'] === '10' ? 'selected' : '' ?>>Статус обычный</option>
                            </select>
                            <button type="submit" name="saveUser">Обновить</button>
                        </form>
                    </td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="userId" value="<?= $user['id'] ?>">
                            <input type="password" name="password" placeholder="Новый пароль">
                            <button type="submit" name="changePassword" onclick="showPasswordModal(<?= $user['id'] ?>)">Изменить</button>
                        </form>
                    </td>
                    <td>
                        <?php if (!empty($user['avatars'])): ?>
                            <img src="<?= getAvatarImage($user['avatars']) ?>" alt="Аватар" width="100" height="100">
                            <form method="POST">
                                <input type="hidden" name="userId" value="<?= $user['id'] ?>">
                                <button type="submit" name="deleteAvatar">Удалить аватар</button>
                            </form>
                        <?php endif; ?>
                    </td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="userId" value="<?= $user['id'] ?>">
                            <button type="submit" name="delete" onclick="confirmDeleteUser(<?= $user['id'] ?>)">Удалить</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
    <script>
var saveUserButton = document.querySelector('button[name="saveUser"]');

saveUserButton.addEventListener('click', function() {
  // Выводим модальное окно с текстом "Статус пользователя обновлен"
  alert('Статус пользователя обновлен');

  // Обновляем страницу
location.reload()
});





    </script>
</body>
</html>




