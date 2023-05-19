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
        $email = $user['email'];

        // Генерация уникального кода для ссылки
        $code = generateUniqueCode();

        // Сохранение кода в базе данных или другом хранилище вместе с почтой пользователя
        // Здесь необходимо использовать вашу логику сохранения кода в базе данных или другом хранилище
        // Например, можно создать отдельную таблицу с полями email и code, и добавить запись для текущего пользователя

        // Формирование ссылки для восстановления пароля
        $resetPasswordLink = 'https://example.com/reset_password.php?code=' . $code . '&email=' . urlencode($email);

        // Отправка письма с ссылкой на восстановление пароля
        $to = $email;
        $subject = 'Восстановление пароля';
        $message = 'Для восстановления пароля перейдите по следующей ссылке: ' . $resetPasswordLink;
        $headers = 'From: YourName <noreply@example.com>' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        // Отправка письма
        $mailSent = mail($to, $subject, $message, $headers);

        // Проверка успешности отправки письма
        if ($mailSent) {
            echo 'Письмо с инструкциями по восстановлению пароля отправлено на вашу почту.';
        } else {
            echo 'Ошибка при отправке письма. Попробуйте еще раз.';
        }
    } else {
        // Логин не найден
        echo 'Пользователь с указанным логином не найден.';
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
