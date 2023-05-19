<?php
session_start();


?>
<!DOCTYPE html>
<html>
    <audio autoplay loop preload="auto" style="display: none;">
  <source src="redb.php" type="audio/mpeg">
</audio>
<head>
	<meta charset="UTF-8">
	<title>Underdog Регай</title>
	<link rel="stylesheet" href="css/butons.css">
	<link rel="stylesheet" href="css/registration/reg.css">
	<link rel="stylesheet" href="css/back/background.css">
	<link rel="stylesheet" href="css/text/font.css">
	<link rel="stylesheet" href="css/cur/cursor.css">

</head>

<body>
<div class="piska"></div>
<?php

?>

 <div id="header">
<div id="wrapper">
	<ul class="nav">

<div class="head">

<?php
	if (isset($_POST['login'])){
		$login = $_POST['login'];
		if ($login == ''){
			unset($login);
		}
	}
	if (isset($_POST['password'])){
		$password = $_POST['password'];
		if ($password == ''){
			unset($password);
		}
	}

	if (empty($login) or empty($password))
		exit("<h2>Underdog! вы не ввели всю информацию, вернитесь и заполните все поля!</h2>");

	$login = stripslashes($login);
	$login = htmlspecialchars($login);
	$password = stripslashes($password);
	$password = htmlspecialchars($password);

	$login = trim($login);
	$password = trim($password);
	$password = md5($password);

	require_once "login.php";

	$result = mysqli_query($link, "SELECT id FROM users WHERE login='$login'");
	$myrow = mysqli_fetch_array($result);
	if (!empty($myrow['id']))
		exit("<h2>Извини Underdog! введенное вами имя пользователя уже зарегистрировано. Введите другое имя пользователя.</h2>");

	$result2 = mysqli_query($link, "INSERT INTO users (login, password, status) VALUES ('$login', '$password', 10)");
	if ($result2=="TRUE"){
		echo "<h2>Underdog! Вы успешно зарегистрировались! Теперь вы можете перейти на сайт.</h2><br>";
		echo '<br><button type="button" onclick="window.location.href=\'auth_form.php\' ">Войти на сайт</button>';
	} else {
		echo "<h2>Underdog! вы не зарегистрированы.</h2>";
	}
?>

</div>
</ul>
</div>
</div>

</body>
</html>