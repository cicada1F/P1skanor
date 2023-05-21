<?php
// Ваш код для подключения к базе данных в файле login.php
include 'login.php';

// Функция для генерации уникального кода для ссылки
function generateUniqueCode($length = 32) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $code = '';
  for ($i = 0; $i < $length; $i++) {
    $code .= $characters[rand(0, strlen($characters) - 1)];
  }
  return $code;
}

// Переменная для проверки успешности отправки письма
$mailSent = false;

// Обработка формы восстановления пароля
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение введенного пользователем логина
    $login = $_POST['login'] ?? '';

    // Проверка наличия логина в базе данных
    $query = "SELECT * FROM users WHERE login = '$login'";
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) === 1) {
        // Логин найден, можно выполнить логику восстановления пароля
        $user = mysqli_fetch_assoc($result);
        $email = $user['login'];

        // Генерация уникального кода для ссылки
        $code = generateUniqueCode();

        // Обновление поля "codereset" в базе данных
        $updateQuery = "UPDATE users SET codereset = '$code' WHERE login = '$login'";
        $updateResult = mysqli_query($link, $updateQuery);

        if ($updateResult) {
            // Поле успешно обновлено, продолжаем с отправкой письма

            // Формирование ссылки для восстановления пароля
            $resetPasswordLink = 'https://example.com/reset_password.php?code=' . $code . '&email=' . urlencode($email);

            // Отправка письма с ссылкой на восстановление пароля
            $to = $email;
            $subject = 'Восстановление пароля';
            $message = 'Для восстановления пароля перейдите по следующей ссылке: ' . $resetPasswordLink;
            $headers = 'From: Suppoty <P1skanorSupport@golov4lena.com>' . "\r\n";
           
            // Отправка письма
            $mailSent = mail($to, $subject, $message, $headers);

            // Проверка успешности отправки письма
            if ($mailSent) {
                echo '<script>alert("Письмо с инструкциями по восстановлению пароля отправлено на вашу почту.");';
                echo 'window.location.href = "auth_form.php";</script>';
            } else {
                echo '<script>alert("Ошибка при отправке письма. Попробуйте еще раз.");</script>';
            }
        } else {
            // Ошибка при обновлении поля
            echo '<script>alert("Ошибка при обновлении поля codereset. Попробуйте еще раз.");</script>';
            // Можно добавить дополнительную обработку ошибки или прервать выполнение скрипта
            exit;
        }
    } else {
        // Логин не найден
        echo '<script>alert("Пользователь с указанным логином не найден.");</script>';
    }
}

mysqli_close($link);
?>

<!-- Форма восстановления пароля -->
<form method="POST">
    <label for="login">Логин:</label>
    <input type="text" id="login" name="login" required>
    <button type="submit">Восстановить пароль</button>
</form>
