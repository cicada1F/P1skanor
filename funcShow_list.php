<?php
$status = isset($_SESSION['status']) ? $_SESSION['status'] : null;

if ($status == 2) {
    echo '<h3>Если вы редактор, то вы можете только обновлять информацию</h3>';
}

	function show_list($link){
		global $link;

		$que = 'SELECT * FROM active';
		$res = mysqli_query($link, $que);
		echo '<div class="d_cont">
		<h1>Список Услуг</h1>
		
		
		<br><table border="1" class="data_tbl">
		<tr align="center"><th>Наименование</th><th>спектр услуг</th><th>Доп. услуги</th><th>Средняя оценка поставщика</th><th>Цена от</th><th>Описание</th></tr>
		';
echo '<head>';
echo '<link rel="stylesheet" href="css/table.css"';
echo '<head>';
// ________________________________________________




if (empty($_SESSION['id'])){

    $ratings = array();
    $query = "SELECT r.service_id, AVG(r.rating) AS rating FROM reviews r INNER JOIN active a ON r.service_id = a.id_act GROUP BY r.service_id";

    $result = mysqli_query($link, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $ratings[$row['service_id']] = $row['rating'];
    }

    while ($item = mysqli_fetch_array($res)){
        $que1 = 'SELECT * FROM category WHERE id_cat = '.$item['id_cat'];
        $res1 = mysqli_fetch_array(mysqli_query($link, $que1));

           // Проверяем, есть ли оценка поставщика в базе данных
        if (isset($ratings[$item['id_act']]) && $ratings[$item['id_act']] > 0) {
            $average_rating = round($ratings[$item['id_act']], 1);
        } else {
            $average_rating = null;
        }



        echo '<tr align="center" class="tbl">
        <td>'.$item['name_act'].'</td>
        <td>'.$res1['name_cat'].'</td>
        <td>'.$item['ed_izm'].'</td>
        <td>'.($average_rating ? number_format($average_rating, 1) : '_никто еще не оценил данное, оставьте свой отзыв первым_').'</td>
        <td>'.$item['price'].'</td>
        <td>'.$item['comments'].'</td>';
    }
}




// ________________________________________________

		elseif ($_SESSION['status'] == 1 || $_SESSION['status'] == 2) 

		{
 $ratings = array();
    $query = "SELECT r.service_id, AVG(r.rating) AS rating FROM reviews r INNER JOIN active a ON r.service_id = a.id_act GROUP BY r.service_id";
    $result = mysqli_query($link, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $ratings[$row['service_id']] = $row['rating'];
    }





			while ($item = mysqli_fetch_array($res)){
				$que1 = 'SELECT * FROM category WHERE id_cat = '.$item['id_cat'];
			$res1 = mysqli_fetch_array(mysqli_query($link, $que1));

     // Проверяем, есть ли оценка поставщика в базе данных
        if (isset($ratings[$item['id_act']]) && $ratings[$item['id_act']] > 0) {
            $average_rating = round($ratings[$item['id_act']], 1);
        } else {
            $average_rating = null;
        }


echo '<tr align="center" class="tbl">
	<td>'.$item['name_act'].'</td>
	<td>'.$res1['name_cat'].'</td>
	<td>'.$item['ed_izm'].'</td>
	<td>'.($average_rating ? number_format($average_rating, 1) : '_никто еще не оценил данное, оставьте свой отзыв первым_').'</td>
	<td>'.$item['price'].'</td>
	<td>'.$item['comments'].'</td>';

if ($_SESSION['status'] == 1) {
	echo '<td><a href="'.$_SERVER['PHP_SELF'].'?action=editform&id_act='.$item['id_act'].'"><img src="img/edit.png" title="Редактировать"></a></td>
	<td><a href="'.$_SERVER['PHP_SELF'].'?action=delete&id_act='.$item['id_act'].'" onClick="return confirmDelete();"><img src="img/drop.png" title="Удалить"></a></td>';
} elseif ($_SESSION['status'] == 2) {
	echo '<td><a href="'.$_SERVER['PHP_SELF'].'?action=editform&id_act='.$item['id_act'].'"><img src="img/edit.png" title="Редактировать"></a></td>
	<td></td>';
} else {
	echo '<td></td><td></td>';
}

echo '</tr>';

}

if ($_SESSION['status'] == 1) {
	echo '<tr align="center"><td colspan="11">
		<a href="'.$_SERVER['PHP_SELF'].'?action=addform"><div class="center"><button type="button">Добавить</button></div></a>
		</td></tr>';
}

echo '</table>
	</div>';
		}



		 else {

 $ratings = array();
   $query = "SELECT r.service_id, AVG(r.rating) AS rating FROM reviews r INNER JOIN active a ON r.service_id = a.id_act GROUP BY r.service_id";
    $result = mysqli_query($link, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $ratings[$row['service_id']] = $row['rating'];
    }




			while ($item = mysqli_fetch_array($res)){
				$que1 = 'SELECT * FROM category WHERE id_cat = '.$item['id_cat'];
			$res1 = mysqli_fetch_array(mysqli_query($link, $que1));


     // Проверяем, есть ли оценка поставщика в базе данных
        if (isset($ratings[$item['id_act']]) && $ratings[$item['id_act']] > 0) {
            $average_rating = round($ratings[$item['id_act']], 1);
        } else {
            $average_rating = null;
        }		
				echo '<tr align="center" class="tbl">
			<td>'.$item['name_act'].'</td>
			<td>'.$res1['name_cat'].'</td>
			<td>'.$item['ed_izm'].'</td>
			<td>'.($average_rating ? number_format($average_rating, 1) : '_никто еще не оценил данное, оставьте свой отзыв первым_').'</td>
			<td>'.$item['price'].'</td>
			<td>'.$item['comments'].'</td>';



			}
		}
	}
?>