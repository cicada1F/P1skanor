<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
 // подключение чекера ошибок
  require_once 'php_errors.log.php';
// подключение к бд
require_once 'login.php';
// логирую бд запросы
require_once 'db_logs.php';
function return_bytes($val) {
    $val = trim($val);
    $last = strtolower($val[strlen($val) - 1]);
    switch ($last) {
        case 'g':
            $val = floatval($val) * 1024;
            break;
        case 'm':
            $val = floatval($val) * 1024;
            break;
        case 'k':
            $val = floatval($val) * 1024;
            break;
    }
    return $val;
}

// загружаем текущую аватарку пользователя
if (isset($_SESSION['login'])) {
    $login = $_SESSION['login'];
    $query = "SELECT avatars FROM users WHERE login = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, 's', $login);
    mysqli_stmt_execute($stmt);
    $stmt->store_result();
    $result = array();
    if ($stmt->num_rows > 0) {
        $meta = $stmt->result_metadata();
        $params = array();
        while ($field = $meta->fetch_field()) {
            $params[] = &$result[$field->name];
        }
        call_user_func_array(array($stmt, 'bind_result'), $params);
        $stmt->fetch();
        // если у пользователя есть аватарка в базе, выводим ее
        if (!empty($result['avatars'])) {
            $avatar = $result['avatars'];
        } else {
            // если у пользователя нет аватарки в базе, выводим заглушку
            $avatar_path = 'avatars/default.png';
            if (file_exists($avatar_path)) {
                $avatar = file_get_contents($avatar_path);
            } else {
                echo "Ошибка: файл заглушки аватарки не найден";
            }
            // Добавляем сообщение, если выводится заглушка
            echo '<br>';
            echo '<h2>У вас еще не установлена фотография. По умолчанию стоит фото-заглушка.</h2><br>';
        }
    }

// Обработка загрузки новой аватарки
if (isset($_POST['upload_avatar'])) {
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
        $maxFileSize = 100 * 1024 * 1024; // 100MB в байтах
        $avatarSize = $_FILES['avatar']['size'];
        if ($avatarSize > $maxFileSize) {
            echo "Ошибка: размер файла превышает максимально допустимый размер (100MB).";
        } else {
            $avatarContent = file_get_contents($_FILES['avatar']['tmp_name']);
            if (!$avatarContent) {
                echo "Ошибка: не удалось получить содержимое файла";
            } else {
                $query = "UPDATE users SET avatars = ? WHERE login = ?";
                $stmt = mysqli_prepare($link, $query);
                mysqli_stmt_bind_param($stmt, 'ss', $avatarContent, $login);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                // Обновляем текущую аватарку
                $avatar = $avatarContent;

  // Перезагружаем текущую страницу после вывода
 echo '<script>
            alert("Ваша фотография успешно обновлена.");

            window.location.href = window.location.href; // обновляем страницу
        </script>';
        exit(); // прерываем выполнение скрипта, чтобы страница не перезагружалась повторно


























               
           
            }
        }
    }
} 
}
?>
