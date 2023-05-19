<?php
session_start();
?>
<!DOCTYPE html>
<html>
<audio autoplay loop preload="auto" style="display: none;">
  <source src="hdb.php" type="audio/mpeg">
</audio>
<head>
	<title>История</title>
	<link rel="stylesheet" href="css/butons.css">
	<link rel="stylesheet" href="css/history_php/history.css">
	<link rel="stylesheet" href="css/cur/cursor.css">
	<link rel="stylesheet" href="css/back/background.css">
	<link rel="stylesheet" href="css/text/font.css">
	<script type="text/javascript" src="js/script.js"></script>
	<meta charset="UTF-8">
</head>

<body>
	<div class="piska"></div>
<div id="wrapper">
	<div id="header">
		<h1>История отзывов</h1><br>
<ul class="nav">
<button type="button" class="back" onClick="history.back();"><h2><div class="arrow">↪</div></h2></button>
</ul>
		<table>

<?php

// подлкючение к бд
require_once 'login.php'; 
// если подлкючилось то идем дальше

if (isset($_SESSION['login'])) {
    $login = mysqli_real_escape_string($link, $_SESSION['login']);

    $status_query = mysqli_query($link, "SELECT status FROM users WHERE login='$login'");
    if ($status_query && mysqli_num_rows($status_query) > 0) {
        $row = mysqli_fetch_assoc($status_query);
        $status = $row['status'];
        if ($status != 1 && $status != 2) {
            // Перенаправление на страницу main.php
            header("Location: main.php");
            exit;
        }
    }
}

// Вывод сообщения о доступе
if (isset($_SESSION['message'])) {
    echo '<div id="message">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
}



if (!isset($_GET["action"])) {
	$_GET["action"] = "showlist";
}

switch ($_GET["action"]) {
	case 'showlist':
		show_list($link);
		break;
	case 'delete':
		if (isset($_GET['id'])) {
			$reviewId = mysqli_real_escape_string($link, $_GET['id']);
			delete_review($link, $reviewId);
		}
		show_list($link);
		break;
	default:
		show_list($link);
		break;
}

function show_list($link) {
	if (!$link) {
		die("Ошибка соединения: " . mysqli_connect_error());
	}

	$que = 'SELECT r.id, r.user_id, a.name_act, r.comment, r.rating 
			FROM reviews r
			LEFT JOIN active a ON r.service_id = a.id_act
			LEFT JOIN reviews r2 ON r.user_id = r2.user_id AND r.service_id = r2.service_id AND r.id < r2.id
			WHERE r2.id IS NULL OR r.id = r2.id';

	$res = mysqli_query($link, $que);
	if (!$res) {
		die("Ошибка выполнения запроса: " . mysqli_error($link));
	}

	$prev_user = "";
	echo '<table border="1" class="data_tbl">';
	echo '<tr>';
	echo '<th>Пользователь</th>';
	echo '<th>Поставщик услуг</th>';
	echo '<th>Отзыв</th>';
	echo '<th>Оценка пользователя</th>';
	echo '<th>Действия</th>';
	echo '</tr>';
	while ($row = mysqli_fetch_assoc($res)) {
		$reviewId = $row['id'];
		$user = $row['user_id'];
		if ($user != $prev_user) {
			echo '<tr>';
			echo '<td><b>' . $user . '</b></td>';
			$prev_user = $user;
		} else {
			echo '<tr>';
			echo '<td></td>';
		}

		$service = $row['name_act'];
		$comment = $row['comment'] ? $row['comment'] : "<br>Пользователь еще не оставил отзыв<br>";
		$rating = $row['rating'] ? $row['rating'] : "<br>Пользователь не оценил и поставил 0<br>";

		echo '<td>' . $service . '</td>';
		echo '<td>' . $comment . '<br></td>';
		echo '<td>' . $rating . '</td>';
		echo '<td><button onclick="reply(\'' . $user . '\')">Ответить</button><br> <button type="button" onclick="window.location.href=\'?action=delete&id=' . $reviewId . '\'">Удалить</button></td>';
		echo '</tr>';
	}

	echo '</table>';
}

function delete_review($link, $reviewId) {
	$delete_query = "DELETE FROM reviews WHERE id='$reviewId'";
	mysqli_query($link, $delete_query);
}

?>
	

<script>
	function reply(user) {
		var email = user + "";
		var form = document.createElement("form");
		form.action = "send-reply.php";
		form.method = "post";
		form.innerHTML = '<input type="email" name="email" value="' + email + '"><br><textarea name="message"></textarea><br><button type="submit" name="submit">Отправить</button>';

		document.body.appendChild(form);
	}

</script>



<script>
    // Автоматическое скрытие сообщения через 5 секунд
    setTimeout(function() {
        document.getElementById('message').style.display = 'none';
    }, 5000);
</script> 
<br>

</div>

	</div>
</div>
</table>

</body>
</html>