<?php
echo '<head>';
echo '<link rel="stylesheet" href="css/getadditem_php/getadditem.css">';
echo '<link rel="stylesheet" href="css/text/font.css">';
function get_add_item_form(){
	if ($_SESSION['status'] == 1) {
		echo '<div class="d_cont">
			<h2>Добавить</h2><br />
			<form name="addform" action="'.$_SERVER['PHP_SELF'].'?action=add" method="POST">
			<br>
			<table border="1" class="data_tbl">
				<tr style="display: none;">
					<td>Ссылка с названием</td>
					<td>';
							$name = isset($item["name"]) ? $item["name"] : '';
					        $linksite = isset($item["linksite"]) ? $item["linksite"] : '';
					        $formattedText = "<a href='$linksite'>$name</a>";
					        echo "<input type='hidden' name='name_act' value='$formattedText' />";
					        echo $formattedText;
					echo '</td>
				</tr>
				<tr>
					<td>Название фирмы</td>
					<td><input type="text" name="name" value="" /></td>
				</tr>
				<tr>
					<td>Ссылка на оф. сайт</td>
					<td><input type="text" name="linksite" value="" /></td>
				</tr>
				<tr>
					<td>Услуга</td>
					<td>';
					global $link;
					$sql1 = "SELECT * FROM category";
					$res1 = mysqli_query($link, $sql1) or die("Err ".mysqli_error());
					echo '<select name="id_cat">'."\r\n";
					echo '<option selected disabled>Выберите Услугу</option>'."\r\n";
					while ($row = mysqli_fetch_array($res1)){
						$id_cat = intval($row['id_cat']);
						$name_cat = htmlspecialchars($row['name_cat']);
						echo "<option value='$id_cat'>$name_cat</option>\r\n";
					}
		echo '</select></td></tr>
				<tr>
					<td>доп.услуги</td>
					<td><input type="text" name="ed_izm" value="" /></td>
				</tr>
				<tr>
			
				</tr>
				<tr>
					<td>Цена от</td>
					<td><input type="text" name="price" value="" /></td>
				</tr>
				<tr>
					<td>Комментарий</td>
					<td><input type="text" name="comments" value="" /></td>
				</tr>
				<tr align="center">
					<td colspan="2"><button type="submit" value="Сохранить">Сохранить</button></td>
				</tr>
			</table>
			</form>
		</div>';
	} else {
		echo '<meta http-equiv="refresh" content="0;URL=active.php">';
	}
}
?>
