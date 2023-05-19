<?php

function delete_item(){
	if ($_SESSION['status'] == 1) {
		global $link;
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$que = "DELETE FROM active WHERE id_act=".$_POST['id_act'];
			mysqli_query($link, $que) or die("Ошибка ".mysqli_error($link));
			echo '<meta http-equiv="refresh" content="0;URL=active.php">';
			die();
		} else {
			echo '<h3>Это каскадное удаление, будьте аккуратны!</h3>';
			echo '<form method="POST">';
			echo '<input type="hidden" name="id_act" value="'.$_GET['id_act'].'">';
echo '<br>';
		echo '<button type="submit" value="Подтвердить">Подтвердить</button>';

echo '<br>';

			echo '</form>';
				echo '<button onclick="window.history.back()">Назад</button>';
		}
	} else {
		echo '<meta http-equiv="refresh" content="0;URL=active.php">';
	}
}



	?>