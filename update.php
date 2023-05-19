<?php

echo '<header>';
echo '<link rel="stylesheet" href="css/update_php/update.css">';
echo '</header>';
function redirect($url) {
    header('Location: ' . $url);
    exit();
}

// проверяем, авторизован ли пользователь
if (empty($_SESSION['login']) or empty($_SESSION['id'])){
            echo '<h2>ЧЕРТ&nbsp; </h2> <h3>ТЫ КАК ТУТ ОКАЗАЛСЯ!&nbsp;</h3><br>&nbsp;';
            redirect('main.php');
            } else {
            echo '<div class="buttons-container">';
            echo '<div class="log">'.$_SESSION['login'].'</div>';

echo '<button type="button" class="button1" onclick="window.location.href=\'main.php\'"><a>Домой</a></button>';
echo '<button type="button" class="button1" onclick="window.location.href=\'?exit\'">Выход</button>';
include 'chatwith.php';
echo '</div>';
            

        }
        if(isset($_GET['exit'])){
            session_unset();
            session_destroy();
            unset($_SESSION['id']);
            unset($_SESSION['status']);

            echo '<meta http-equiv="refresh" content="0;URL='.$_SERVER['PHP_SELF'].'">';
              redirect('main.php');
// Сбрасываем кэш
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");


            exit;
        }


    
// обработка логина и пароля
if(isset($_POST["submit"])){
    $login = $_POST["login"];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Проверка на совпадение паролей
    if ($password !== $confirmPassword) {
        echo "<script>alert('Ошибка: Пароли не совпадают.');</script>";
    } elseif(empty($login)) {
        echo "<script>alert('Вы не ввели свою почту для обновления пароля.');</script>";
    } else {
        // Захеширование нового пароля
        $hashedPassword = md5($password);

        // Обновление логина и пароля в базе данных
        $query = "UPDATE users SET login = '$login', password = '$hashedPassword' WHERE id = {$_SESSION["id"]}";
        mysqli_query($link, $query);

        // Вывод сообщения об успешном обновлении данных
        $message = "Данные пользователя успешно обновлены!";
        echo "<script>alert('$message');</script>";
    }
} else {
    $message = 'используйте сложный Пароль для вашей безопасности!';
}



 
?>