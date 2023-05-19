<?php

session_start();

// подключение чекера ошибок
error_reporting(E_ALL);
ini_set('display_errors', 1);

// подключение к бд
require_once 'login.php';

// логирую бд запросы
require_once 'db_logs.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_id = isset($_SESSION['login']) ? $_SESSION['login'] : null;
  $tema = isset($_POST['tema']) ? $_POST['tema'] : null;
  $helpa = isset($_POST['helpa']) ? $_POST['helpa'] : null;
  $datapisma = date('Y-m-d H:i:s'); // Получаем текущую дату и время

  // Если пользователь не авторизован, сохраняем его email в поле user_id
  if (!$user_id && isset($_POST['email'])) {
    $email = $_POST['email'];
    $stmt = $link->prepare('INSERT INTO help (user_id, tema, helpa, datapisma) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('ssss', $email, $tema, $helpa, $datapisma);
  } else if ($user_id !== null) { // Иначе сохраняем его user_id
    $stmt = $link->prepare('INSERT INTO help (user_id, tema, helpa, datapisma) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('ssss', $user_id, $tema, $helpa, $datapisma);
  } else {
    echo 'Ошибка: неверное значение user_id';
    exit;
  }

  if ($stmt->execute()) {
    // Выводим сообщение об успешной отправке обращения и просим ожидать ответа
    echo 'Ваше обращение успешно отправлено! Ожидайте ответа.';
    exit;
  } else {
    // Выводим сообщение об ошибке
    echo 'Ошибка при отправке обращения. Код ошибки: ' . $stmt->errno . '. Описание ошибки: ' . $stmt->error;
    exit;
  }
}

?>


<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/butons.css">
  <link rel="stylesheet" href="css/help_php/help.css">
  <link rel="stylesheet" href="css/cursor.css">
  <link rel="stylesheet" href="css/text/font.css">
  <link rel="stylesheet" href="css/back/background.css">
  <title>Страница поддержки</title>
</head>
<body>
  <div class="piska"></div>
  <div id="wrapper">
    <div id="header">
      <ul class="nav">
        <?php
        // подключение меню
        require_once 'menu.php';
        ?>
        <ul class="nav">
          <?php if (isset($_GET['success']) && $_GET['success'] === 'true'): ?>
            <p>Ваше обращение успешно отправлено!</p>
          <?php endif; ?>
          <form method="POST">
            <?php if (!isset($_SESSION['login'])): ?>
              <label for="email">Ваша почта:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" required>
              <br>
            <?php endif; ?>
            <br>
            <label for="tema">Тема обращения:</label>
            <input type="text" id="tema" name="tema" required>
            <br><br>
            <label for="helpa">Текст обращения:</label>
            <textarea id="helpa" name="helpa" required></textarea>
            <br>
            <ul class="gav">
              <button type="submit">Отправить</button>
            </ul>
          </form>
        </ul>
      </ul>
    </div>
  </div>

  <script src="js/textarea.js"></script>
</body>
</html>
