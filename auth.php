<?php
session_start();


?>
<!DOCTYPE html>
<html>
  <audio autoplay loop preload="auto" style="display: none;">
  <source src="audb.php" type="audio/mpeg">
</audio>

<head>
	<title>Underdog Залетай</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/butons.css">
	<link rel="stylesheet" href="css/login/auth.css">
	<link rel="stylesheet" href="css//back/background.css">
	<link rel="stylesheet" href="css/text/font.css">
	<link rel="stylesheet" href="css/cur/cursor.css">
</head>

<body>
<div class="piska"></div>
 <div id="header">
<div id="wrapper">
	 	<ul class="nav">
<button type="button" onClick="window.location.href='main.php'"><h2><div class="arrow">↪</div></h2></button>
</ul>
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

	$result = mysqli_query($link, "SELECT * FROM users WHERE login='$login'");
	$myrow = mysqli_fetch_array($result);
	if (empty($myrow['password'])){
		exit("<h2>Sorry Underdog!, Неверное имя пользователя или пароль.</h2>");
	} else {
		if ($myrow['password']==$password){
			$_SESSION['id'] = $myrow['id'];
			$_SESSION['login'] = $myrow['login'];
			$_SESSION['status'] = $myrow['status'];
			echo "<h2>Приветствуем вас<br>&nbsp;".$_SESSION['login']."</h2><br>";

		} else {
			exit("<h2>Sorry Underdog!, Неверное имя пользователя или пароль.</h2>");
		}
	}
	
?>

</div>
</div>
</div>
</body>
</html>