	<?php
echo '<head>';
echo '<link rel="stylesheet" href="css/chat/chatwith.css"';
echo '</head>';

					if (isset($_SESSION['login'])) {
					    // Получение логина текущей сессии
					    $login = mysqli_real_escape_string($link, $_SESSION['login']);

					    // Получение статуса пользователя из таблицы users
					    $user_query = mysqli_query($link, "SELECT status FROM users WHERE login='$login'");
					    $user_row = mysqli_fetch_assoc($user_query);
					    $status = $user_row['status'];

					    // Вывод ссылки на файл в зависимости от статуса пользователя
					    if ($status == 1 || $status == 2 || $status == 3) {

					        echo '<li><a href="chat.php">Чат с пользователем</a></li>';
					    } else {
					        echo '<li><a href="userchat.php">Чат с администрацией</a></li>';
					    }
						
					}
					?>