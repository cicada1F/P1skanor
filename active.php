<?php
session_start();
?>
<!DOCTYPE html>
<html>
<audio autoplay loop preload="auto" style="display: none;">
  <source src="adb.php" type="audio/mpeg">
</audio>
<head>
	<title>Услуги</title>
	<link rel="stylesheet" href="css/active_php/active.css">
 	<link rel="stylesheet" href="css/cur/cursor.css">
	<link rel="stylesheet" href="css/text/font.css">
      <link rel="stylesheet" href="css/back/background.css">

	<meta charset="UTF-8">
</head>

<body>
	<div class="piska"></div>
  <div id="header">

    <ul class="nav">
<?php
	// ___________________________
	// подключение меню
	require_once 'menu.php';
	// ___________________________
	// подключение к бд
	require_once 'login.php';
		// подключение функционала админа
		include 'funcShow_list.php';
		include 'funcGetEditItem.php';
		include 'funcUpdateItem.php';

	if (isset($_SESSION['status']) && $_SESSION['status'] == 1) {
    include 'funcGetAddItem.php';
    include 'funcAddItem.php';
    include 'funcDeleteItem.php';
	}



	if (!isset($_GET["action"])) $_GET["action"] = "showlist";

$status = isset($_SESSION['status']) ? $_SESSION['status'] : null;

if (!$status) {
    echo '<br>';
    echo '<h2>Оставлять отзывы могут только авторизованные пользователи.</h2><br>';
} else if ($status == 1 || $status == 2) {
    echo '<br>';
    echo '<h2>Здесь вы можете редактировать информацию.</h2><br>';
} else if ($status == 3) {
    echo '<br>';
    echo '<h2>Ты не можешь оставлять отзыв, ты всего лишь поддержка.</h2><br>';
} else {
    echo '<br>';
    echo '<h2>Здесь мы можете оставить свой отзыв об услуге поставщика:</h2><br>';
    echo '<div class="cntr"><button type="button" onclick="window.location.href=\'department.php\'">Оставить Отзыв<sup>*</sup></button></div><br>';

    echo '<div class="star"><sup>*</sup> — Вы можете оставить отзыв одновременно только на одну услугу.</div>';
    echo '<br>';
}


switch ($_GET["action"]) {
    case 'buy':
        addBuy($link);
        break;
    case 'showlist':
        show_list($link);
        break;
    case 'addform':
    case 'add':
    case 'delete':
        if (isset($_SESSION['status']) && $_SESSION['status'] == 1) {
            if ($_GET["action"] == 'addform') {
                get_add_item_form($link);
            } elseif ($_GET["action"] == 'add') {
                add_item($link);
            } elseif ($_GET["action"] == 'delete') {
                delete_item($link);
            }
        }
        break;
    case 'editform':
        get_edit_item_form($link);
        break;
    case 'update':
        update_item($link);
        break;
    default:
        show_list($link);
        break;
}


?>
</ul>
</div>
</body>
</html>