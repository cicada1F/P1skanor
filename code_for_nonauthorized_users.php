<head>
    <link rel="stylesheet" href="css/butons.css">
</head>
<body>
<div class="avatar-container">
    <div class="links">
        <button onclick="window.location.href='reg_form.php'">Регистрация</button><br>
        <button onclick="window.location.href='auth_form.php'">Войти</button><br>
        <?php
        // if ($_SERVER['REQUEST_URI'] != '/siteP1/main.php') {
        //     echo '<button onclick="window.location.href=\'main.php\'">Домой</button>';
        // }
        ?>
    </div>

    <?php
    // Если пользователь не авторизован, загружаем заглушку
    $avatar_path = 'avatars/nonauth.png';
    if (file_exists($avatar_path)) {
        $avatar = file_get_contents($avatar_path);
        // Отображаем заглушку аватарки
        echo '<img src="data:image/jpeg;base64,' . base64_encode($avatar) . '" width="150" height="150" alt="Avatar">';
        echo '<div class="noname">Привет Ноунейм!</div>';
    } else {
        echo "Ошибка: файл заглушки аватарки не найден";
    }
    ?>
</div>
</body>