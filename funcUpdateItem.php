<?php
function update_item(){
		global $link;
		$name_act = mysqli_escape_string($link, $_POST['name_act']);
		$id_cat = mysqli_escape_string($link, $_POST['id_cat']);
		$ed_izm = mysqli_escape_string($link, $_POST['ed_izm']);
		
		$price = mysqli_escape_string($link, $_POST['price']);
		$comments = mysqli_escape_string($link, $_POST['comments']);
		$que = "UPDATE active SET name_act='$name_act', id_cat='$id_cat', ed_izm='$ed_izm',  price='$price', comments='$comments' WHERE id_act=".$_GET['id_act'];
		mysqli_query($link, $que) or die("Ошибка ".mysqli_error($link));
		echo '<meta http-equiv="refresh" content="0;URL=active.php">';
		die();
	}
	?>