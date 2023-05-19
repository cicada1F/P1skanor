</!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
<link rel="stylesheet" href="css/butons.css">
<link rel="stylesheet" href="css/menu_php/menu.css">
<link rel="stylesheet" href="css/cur/cursor.css">
<link rel="stylesheet" href="css/text/font.css">
</head>
<body>
	

    <div id="wrapper">
	<div class="d_reg">

		<div id="head">
			<ul class="nav">

<!-- <button type="button" class="back" onclick="history.back()"><div class="arrow">↪</div></button> -->
<?php
if ($_SERVER['REQUEST_URI'] !== '/siteP1/main.php') {
    echo '<button type="button" class="back" onclick="history.back()"><div class="arrow">↪</div></button>';
}
?>


</ul>
<ul class="nav">
		<?php

// подключение чекера ошибок
error_reporting(E_ALL);
ini_set('display_errors', 1);
// проверка версии php
include 'chek.php';
// подключение к бд и там же стартуем сессию
require_once 'login.php';

// // логирую бд запросы
 require_once 'db_logs.php';




// проверяем авторизацию пользователя
if (empty($_SESSION['login']) || empty($_SESSION['id'])) 
{

        // если юзер не авторизированн
          require_once 'code_for_nonauthorized_users.php';

} 


else 
    {



// если юзер авторизированн
require_once 'code_for_authorized_users.php'; 


    }



    ?>

				

	</ul>
</div>
</div>
</div>
</body>
</html>
