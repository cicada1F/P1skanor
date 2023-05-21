<div class="avatar-container">
 

<!-- уведомления о новых обращениях -->
      <?php
       include 'obrchek.php';
      ?>

<!-- уведомления о новых сообщениях -->
      <?php
      include 'mailchek.php';
      ?>
      

      





  <div class="avatar">
    <?php
    // загружаем аватарку пользователя из базы данных
    if (isset($_SESSION['id'])) {
      $query = "SELECT avatars FROM users WHERE id = " . intval($_SESSION['id']);
      $result = mysqli_query($link, $query);
      if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (!empty($row['avatars'])) {
          // отображаем аватар пользователя
          echo '<img src="data:image/jpeg;base64,' . base64_encode($row['avatars']) . '" alt="A1" width="150" height="150" >';
        } else {
          // если у пользователя нет аватарки в базе, выводим заглушку
          $avatar_path = 'avatars/default.png';
          if (file_exists($avatar_path)) {
            $avatar = file_get_contents($avatar_path);
            // отображаем заглушку аватарки
            echo '<img src="data:image/jpeg;base64,' . base64_encode($avatar) . '" alt="Avatar" width="150" height="150"  >';
          } else {
            echo "Ошибка...";
          }
        }
      }
    }
        if (isset($_GET['exit'])) {
        session_unset();
        session_destroy();
        unset($_SESSION['id']);
        unset($_SESSION['status']);
        // сбрасываем куки
        // setcookie('cookie_name', '', time() - 3600, '/');
        // сбрасываем кэш
        header("Cache-Control: no-cache, must-revalidate");
        echo '<meta http-equiv="refresh" content="0; URL=' . $_SERVER['PHP_SELF'] . '">';
        exit;
    }      

    ?>
  </div>
<div class="user-info">
    <div class="links">
      <select onchange="window.location.href=this.value;">
        <option value="" disabled selected hidden style="font-family: Lucida Console"><?php echo $_SESSION['login']; ?></option>
        <?php
        if (!empty($_SESSION['id']) && $_SESSION['status'] == 1) {
          echo '<option value="category.php" style="font-family: mini-pixel">Редактор</option>';
          echo '<option value="history.php" style="font-family: mini-pixel">История</option>';
          echo '<option value="gigachad.php" style="font-family: mini-pixel">Бог</option>';
          
        }
        if (!empty($_SESSION['id']) && $_SESSION['status'] == 2) {
          echo '<option value="history.php" style="font-family: mini-pixel">История</option>';
        }
        if ($_SERVER['PHP_SELF'] != '/main.php') {
          echo '<option value="main.php" style="font-family: mini-pixel">Домой</option>';
        }
        ?>
        <option value="UserPage.php" style="font-family: mini-pixel">Профиль</option>
        <option value="?exit" style="font-family: mini-pixel">Выход</option>
      </select>
    </div>

</div>
