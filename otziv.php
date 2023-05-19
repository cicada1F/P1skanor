<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/butons.css">
	<link rel="stylesheet" href="css/otziv_php/otziv.css">
 	<link rel="stylesheet" href="css/cur/cursor.css">
	<link rel="stylesheet" href="css/text/font.css">
      <link rel="stylesheet" href="css/back/background.css">
  <title>Страница отзывов</title>
</head>
<body>


<div class="piska"></div>
<div id="back"><button type="button" onclick="history.back()"><div class="arrow">↪</div></button>
<div id="wrapper">  
<div id="header">

<ul class="nav">

<?php
// устанавливаем соединение с базой данных
require_once 'login.php';


  // ___________________________



// устанавливаем правильную кодировку
header('Content-Type: text/html; charset=utf-8');

if ($link->connect_error) die($link->connect_error);

// выбираем поля rating, comment, user_id, service_id и category_id из таблицы reviews, а также имена категорий и действий из таблицы category и active, связанных с reviews через соответствующие поля
$query = "SELECT r.rating, r.comment, CONCAT(SUBSTRING(r.user_id, 1, LENGTH(r.user_id)/4), '***') AS user_id, a.name_act, c.name_cat FROM reviews AS r JOIN active AS a ON r.service_id = a.id_act JOIN category AS c ON r.category_id = c.id_cat";

$result = $link->query($query);
if (!$result) die($link->error);

// выводим результаты
while ($row = $result->fetch_assoc()) {

echo '<div class="otzivi">';

  echo "Оценка: " . $row["rating"] . "<br>";
  echo "<br>";
  echo "Комментарий: " . $row["comment"] . "<br>";
echo "<br>";
  echo "Пользователь: " . $row["user_id"] . "<br>";
echo "<br>";
  echo "Поставщик: " . $row["name_act"] . "<br>";
echo "<br>";
  echo "Категория: " . $row["name_cat"] . "<br><br>";
echo '</div>';
}

// закрываем соединение с базой данных
$result->close();
$link->close();
echo '</ul>';


?>

</div>
</div>
</div>
</body>
</html>