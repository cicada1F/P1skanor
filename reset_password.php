<?php
// Ваш код для подключения к базе данных в файле login.php
include 'login.php';
// Проверка наличия кода в URL
if (isset($_GET['code']) && isset($_GET['email'])) {
  $code = $_GET['code'];
  $email = $_GET['email'];

  // Проверка наличия кода в базе данных или другом хранилище
  $query = "SELECT * FROM users WHERE login = '$email' AND codereset = '$code'";
  $result = mysqli_query($link, $query);

  if (mysqli_num_rows($result) === 1) {
    // Код найден, можно продолжить обработку и выводить форму смены пароля
    // В этом месте можно добавить дополнительные проверки, например, на срок действия ссылки и другие условия

    // Получение нового пароля из формы и его подтверждение
    if (isset($_POST['password']) && isset($_POST['confirm_password'])) {
      $password = $_POST['password'];
      $confirmPassword = $_POST['confirm_password'];

      // Проверка совпадения введенных паролей
      if ($password === $confirmPassword) {
        // Хеширование пароля с использованием md5()
        $hashedPassword = md5($password);

        // Обновление пароля в базе данных
        $updateQuery = "UPDATE users SET password = '$hashedPassword' WHERE login = '$email'";
        $updateResult = mysqli_query($link, $updateQuery);

        if ($updateResult) {
          // Пароль успешно обновлен
          echo 'Пароль успешно обновлен.';
        } else {
          echo 'Ошибка при обновлении пароля. Попробуйте еще раз.';
        }
      } else {
        echo 'Введенные пароли не совпадают.';
      }
    }

    // Вывод формы смены пароля
    ?>
    <!-- Форма смены пароля -->
    <form method="POST">
      <label for="password">Новый пароль:</label>
      <input type="password" id="password" name="password" required>
      <label for="confirm_password">Подтвердите пароль:</label>
      <input type="password" id="confirm_password" name="confirm_password" required>
      <button type="submit">Сменить пароль</button>
    </form>
    <?php
  } else {
    // Код не найден или не совпадает, можно вывести соответствующее сообщение или выполнить другие действия
    echo 'Неправильный код для восстановления пароля.';
  }
} else {
  // Если код не указан в URL, можно выполнить соответствующие действия, например, перенаправить пользователя или вывести сообщение об ошибке
  echo 'Код для восстановления пароля не найден.';
}

mysqli_close($link);
?>
