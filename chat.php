<?php
session_start();

?>
<!DOCTYPE html>
<html>
<body>
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Чат с пользователями</title>
	<link rel="stylesheet" href="css/chat/chat.css">
 	<link rel="stylesheet" href="css/cur/cursor.css">
	<link rel="stylesheet" href="css/text/font.css">
      <link rel="stylesheet" href="css/back/background.css">
	<link rel="stylesheet" href="css/butons.css">
</head>
<div class="piska"></div>
<div id="wrapper">
  <div id="header">
<ul class="nav">
<?php
// подключение меню
require_once 'menu.php';
?>
    <ul class="nav">
<?php
// подлкючение к бд 
require_once 'login.php';
// Проверка авторизации пользователя
if (!isset($_SESSION['login'])) {
    echo '<script>window.location.href = "main.php";</script>';
    exit; // Завершение выполнения скрипта
}
if (isset($_POST['submit']) && isset($_SESSION['login']) && in_array($_SESSION['status'], array(1, 2, 3))) {
    $user_id = mysqli_real_escape_string($link, $_POST['user_id']);
    $tema = mysqli_real_escape_string($link, $_POST['tema']);
    $answer = mysqli_real_escape_string($link, $_POST['answer']);
    $face = $_SESSION['status'];
    $facelog = $_SESSION['login'];
    date_default_timezone_set('Europe/Moscow');
    $date = date('Y-m-d H:i:s');
    if ($user_id && $tema && $answer) { // Проверяем, что все поля заполнены
        $face_query = mysqli_query($link, "INSERT INTO chat (user_id, tema, answer, face, facelog, date) VALUES ('$user_id', '$tema', '$answer', '$face', '$facelog', '$date')");
        if ($face_query) {
            echo "<p>Ваш ответ был успешно сохранен.</p>";
        } else {
            echo "<p>Ошибка при сохранении ответа.</p>";
        }
    } else {
        echo "<p>Заполните все поля формы.</p>";
    }
}
if (isset($_SESSION['login']) && in_array($_SESSION['status'], array(1, 2, 3))) {
    $user_query = mysqli_query($link, "SELECT user_id FROM help GROUP BY user_id");
    $login = mysqli_real_escape_string($link, $_SESSION['login']);
    $chat_page = basename($_SERVER['PHP_SELF']) === 'chat.php';

    if ($chat_page) {
        // Обновляем поле last_notification_adm, устанавливая текущую дату и время
        $update_query = "UPDATE chat SET last_notification_adm = NOW() WHERE facelog='$login'";
        $result = mysqli_query($link, $update_query);

        if ($result) {
            // echo "Поле last_notification_adm успешно обновлено.";
        } else {
            echo "Ошибка при обновлении поля last_notification_adm: " . mysqli_error($link);
        }
    }
?>

<form method="post">
  <label for="user_id">Выберите пользователя:</label>
  <select name="user_id" id="user_id" >

    <option value="">Список пользователей</option> <!-- Пустой вариант по умолчанию -->
    <?php while ($user_row = mysqli_fetch_assoc($user_query)) { ?>
      <option value="<?php echo $user_row['user_id']; ?>"><?php echo $user_row['user_id']; ?></option>
    <?php } ?>
  </select><br>
  <br>
  <label for="tema">Выберите тему:</label><br>
  <select name="tema" id="tema">
    <!-- Пустой вариант будет отображаться только после выбора пользователя -->
  </select><br>
  
  <br>
  <label for="answer">Ваш ответ:</label><br>
  <textarea name="answer" id="answer" rows="5" cols="40"></textarea>
  <div id="user_help"><br></div> <!-- Здесь будет отображаться обращение пользователя --><br>
  <button type="submit" name="submit">Отправить</button>
</form>
<br>

<script>
  // Обработчик события выбора пользователя
  document.getElementById("user_id").addEventListener("change", function() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("tema").innerHTML = "<option value=''>Выберите тему</option>" + this.responseText; // Обновляем список тем
        document.getElementById("user_help").innerHTML = ""; // Очищаем область отображения обращения
      }
    };
    xhr.open("GET", "get_tema.php?user_id=" + this.value, true);
    xhr.send();
  });

  // Обработчик события выбора темы
  document.getElementById("tema").addEventListener("change", function() {
    var user_id = document.getElementById("user_id").value;
    var tema = this.value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("user_help").innerHTML = this.responseText; // Отображаем обращение пользователя
      }
    };
    xhr.open("GET", "get_helpa.php?user_id=" + user_id + "&tema=" + tema, true);
    xhr.send();
  });
</script>
<?php
} else {
  echo "<p>У вас нет прав для отправки сообщений.</p>";
}
?>
</ul>
</ul>
</div>
</div>
</body>
</html>