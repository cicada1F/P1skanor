<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<link rel="stylesheet" href="css/back/background.css">
<link rel="stylesheet" href="css/UserPage_php/UserPage.css">
<link rel="stylesheet" href="css/butons.css">
<link rel="stylesheet" href="css/cur/cursor.css">
<link rel="stylesheet" href="css/text/font.css">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');
</style>
    <title>Профиль</title>
   
</head>
<body>


<div id="message-container">
 
  
</div>
<div class="piska"></div>

<duv class="container">
      <div class="wrapper">
<div id="header">
  
<ul class="nav">
<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'on');
session_start();
// подключаемся к базе данных
require_once 'login.php';
// подключаем логгер ошибок
require_once 'php_errors.log.php';
// логируем SQL-запросы
require_once 'db_logs.php';
 // подключение функционала обновления логина и пароля
        include 'update.php';
 // подключение функционала удаления аватара
       include 'del.php';
    // подключение функционала обновления аватара
       include 'upload.php';
// mysqli_close($link);
?>

</ul>
<br>
 <h1>Обновление информации о вашей электронной почте и пароле </h1>
    
    <form method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
<ul class="warn">
<li>        
	<label for="login">Введите почту:</label><br>
        <input type="text" name="login" id="login">

        <br><br>
        <label for="password">Введите пароль:</label><br>
        <input type="password" name="password" id="password"><br><br>
        <label for="confirm_password">Подтвердите пароль:</label><br>
        <input type="password" name="confirm_password" id="confirm_password"><br>

        <br>
        <button type="submit" name="submit" class="upd">


<div class="panda_face">
        <svg x="0px" y="0px" width="100%" height="100%" viewBox="0 0 91.7 71.3" >
          <path class="panda_icon panda_white" d="M86.6,20.4v15.3h5.1v20.4h-5.1v5.1h-5.1v5H71.3v5.1H20.4v-5.1H10.2v-5H5.1v-5.1H0V35.7h5.1V20.4L25.5,5.1h40.7L86.6,20.4z"/>
          <path class="panda_icon pink" d="M40.7,45.8h10.2v5.1H40.7V45.8z M10.2,25.4H5.1v-5.1H0V10.2h5.1V5.1h5.1V0h10.2v5.1h5.1v5.1h-5.1v5.1h-5.1v5h-5.1V25.4z
            M30.5,45.8h-5v5.1H15.3V35.6h5.1v-5.1h10.1V45.8z M61.1,56H56v5.1H35.6V56H56v-5.1h5.1V56z M76.4,50.9H66.2v-5.1h-5.1V30.5h10.2
          v5.1h5.1V50.9z M91.7,20.3h-5.1v5.1h-5.1v-5.1h-5.1v-5h-5.1v-5.1h-5.1V5.1h5.1V0h10.2v5.1h5.1v5.1h5.1V20.3z"/>
        </svg>
      </div>
      <span>Обновить</span>
       










    </button>
        <br>
<div id="error-message"><?php echo $message; ?></div>

</li>


<br>
</ul>

    </form>

<h1>Обновить аватарку</h1>
<?php
 echo "<img src='data:image/jpeg;base64," . base64_encode($avatar) . "' alt='Avatar' width='150' height='150'>";
?>



<form method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
    <p>Ваше изображение будет выводиться в формате квадрата (150x150), примите это к сведению при загрузке файла</p>
    <label for="avatar">Выбрать новую аватарку (максимальный вес изображения не должен превышать 20 мегабайт):</label>
    <input type="file" name="avatar" id="avatar">

    <button type="submit" class="button" name="upload_avatar" >
        <div class="panda_face">
        <svg x="0px" y="0px" width="100%" height="100%" viewBox="0 0 91.7 71.3" >
          <path class="panda_icon panda_white" d="M86.6,20.4v15.3h5.1v20.4h-5.1v5.1h-5.1v5H71.3v5.1H20.4v-5.1H10.2v-5H5.1v-5.1H0V35.7h5.1V20.4L25.5,5.1h40.7L86.6,20.4z"/>
          <path class="panda_icon pink" d="M40.7,45.8h10.2v5.1H40.7V45.8z M10.2,25.4H5.1v-5.1H0V10.2h5.1V5.1h5.1V0h10.2v5.1h5.1v5.1h-5.1v5.1h-5.1v5h-5.1V25.4z
            M30.5,45.8h-5v5.1H15.3V35.6h5.1v-5.1h10.1V45.8z M61.1,56H56v5.1H35.6V56H56v-5.1h5.1V56z M76.4,50.9H66.2v-5.1h-5.1V30.5h10.2
          v5.1h5.1V50.9z M91.7,20.3h-5.1v5.1h-5.1v-5.1h-5.1v-5h-5.1v-5.1h-5.1V5.1h5.1V0h10.2v5.1h5.1v5.1h5.1V20.3z"/>
        </svg>
      </div>
      <span>Загрузить аватарку</span>
        
    </button>

</form> 
<br>

    <h1>Удаление аватарки</h1><br>
    <p>Вы уверены, что хотите удалить свою аватарку?</p>
<form method="post">
    <button type="submit" name="delete_avatar" class="center">
<div class="panda_face">
        <svg x="0px" y="0px" width="100%" height="100%" viewBox="0 0 91.7 71.3" >
          <path class="panda_icon panda_white" d="M86.6,20.4v15.3h5.1v20.4h-5.1v5.1h-5.1v5H71.3v5.1H20.4v-5.1H10.2v-5H5.1v-5.1H0V35.7h5.1V20.4L25.5,5.1h40.7L86.6,20.4z"/>
          <path class="panda_icon pink" d="M40.7,45.8h10.2v5.1H40.7V45.8z M10.2,25.4H5.1v-5.1H0V10.2h5.1V5.1h5.1V0h10.2v5.1h5.1v5.1h-5.1v5.1h-5.1v5h-5.1V25.4z
            M30.5,45.8h-5v5.1H15.3V35.6h5.1v-5.1h10.1V45.8z M61.1,56H56v5.1H35.6V56H56v-5.1h5.1V56z M76.4,50.9H66.2v-5.1h-5.1V30.5h10.2
          v5.1h5.1V50.9z M91.7,20.3h-5.1v5.1h-5.1v-5.1h-5.1v-5h-5.1v-5.1h-5.1V5.1h5.1V0h10.2v5.1h5.1v5.1h5.1V20.3z"/>
        </svg>
      </div>
      <span>Удалить аватарку</span>
   


</button>
</form>




</div>
    
  
  
  <div class="cover"></div>
 <script src="js/USerPAge/UserPage.js"></script> 



<script src="js/USerPAge/upload.js"></script>
<!-- <script src="js/butons.js"></script> -->


</body>
</html>
<path class="panda_icon panda_white" d="M86.6,20.4v15.3h5.1v20.4h-5.1v5.1h-5.1v5H71.3v5.1H20.4v-5.1H10.2v-5H5.1v-5.1H0V35.7h5.1V20.4L25.5,5.1h40.7
    L86.6,20.4z"/>