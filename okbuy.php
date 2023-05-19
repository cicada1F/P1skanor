<?php
error_reporting(E_ALL);

require_once 'login.php';

// Проверяем, залогинен ли пользователь
if (!isset($_SESSION['login'])) {

     // Если пользователь не залогинен, выводим сообщение и скрываем форму отправки отзыва
    echo "<h2><br>Чтобы оставить отзыв, пожалуйста, авторизируйтесь на сайте!</h2>";
    // die();
     exit();
}


// Получаем список услуг из БД
$sql_services = "SELECT id_act, name_act FROM active";
$result_services = mysqli_query($link, $sql_services);
if (!$result_services) {
    die("Ошибка получения списка услуг: " . mysqli_error($link));
}
// Получаем список категорий из БД
$sql_categories = "SELECT id_cat, name_cat FROM category";
$result_categories = mysqli_query($link, $sql_categories);
if (!$result_categories) {
    die("Ошибка получения списка категорий: " . mysqli_error($link));
}









if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $service_id = $_POST["service_id"];
    $rating = $_POST["rating"];
    $comment = $_POST["comment"];
    $user_id = $_SESSION['login'];
    $category_id = $_POST["category_id"];

    // Записываем отзыв в базу данных
  

    $sql = "INSERT INTO reviews (service_id, category_id, user_id, rating, comment) VALUES ('$service_id', '$category_id', '$user_id', '$rating', '$comment')";

    if ($link->query($sql) === TRUE) 
      
    {
        echo "<h2>Отзыв успешно отправлен!</h2><br>";
    } else {
        echo "Ошибка при отправке отзыва: " . $link->error;
    }
}





?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="css/okbuy_php/okbuy.css">
    <link rel="stylesheet" href="css/text/font.css">
</head>
<body>
    <h2>Написать отзыв</h2>
 

 <form method="post" action="">

    <label for="service_id">Поставщик:</label>
    <select id="service_id" name="service_id">
        <?php while ($row = mysqli_fetch_assoc($result_services)) { ?>
            <option value="<?php echo $row['id_act']; ?>"><?php echo $row['name_act']; ?></option>
        <?php } ?>
    </select><br>

    <label for="category_id">Категория:</label>
<select id="category_id" name="category_id">
  <?php while ($row = mysqli_fetch_assoc($result_categories)) { ?>
    <option value="<?php echo $row['id_cat']; ?>"><?php echo $row['name_cat']; ?></option>
  <?php } ?>
</select>

    <label for="rating">Оценка:</label>
    <select id="rating" name="rating">
        <option value="0">0 звезд</option>
        <option value="1">1 звезда</option>
        <option value="2">2 звезды</option>
        <option value="3">3 звезды</option>
        <option value="4">4 звезды</option>
        <option value="5">5 звезд</option>
    </select><br>
    <label for="comment">Отзыв:</label>
    <textarea id="comment" name="comment"></textarea><br>
<script src="js/textarea.js"></script>
    <button type="submit">Оставить отзыв</button>
</form>
   

</body>
</html>
