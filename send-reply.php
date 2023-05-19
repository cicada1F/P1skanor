<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <title>История</title>
  <link rel="stylesheet" href="css/history_php/history.css">
  <link rel="stylesheet" href="css/butons.css">
  <link rel="stylesheet" href="css/text/font.css">
  <script type="text/javascript" src="js/script.js"></script>
  <meta charset="UTF-8">
</head>

<body>
  <div class="piska"></div>
  <div id="header">
    <button type="button" onclick="window.location.href='main.php'">Назад</button>
<?php
// подключение к бд
require_once 'login.php'; 
// если подключилось, то идем дальше
if (!empty($_POST)) {
  $email = $_POST['email'];
  $message = $_POST['message'];

  // отправка ответа на email пользователя
  $to = $email;
  $subject = 'Ответ на ваш отзыв';
  $headers = 'From: your_email@example.com' . "\r\n" .
    'Reply-To: your_email@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

  // текст сообщения
  $message = "Здравствуйте!\r\n\r\n";
  $message .= "Вы оставили отзыв на нашем сайте и мы хотели бы ответить на него.\r\n\r\n";
  $message .= "Ответ на ваш отзыв:\r\n";
  $message .= $message;

  // отправляем email
  mail($to, $subject, $message, $headers);

  // выводим сообщение об успешной отправке
  echo "<h3>Сообщение успешно отправлено на адрес</h3> $to";
} else {
  // если запрос не POST, то редиректим на страницу отзывов
  header('Location: history.php');
  exit();
}
?> 
</div>
  </div>

</body>
</html>