<?php
$log_file = 'log.txt';
$log_handle = fopen($log_file, 'a');

$php_min_version = '5.2.8';
$apache_min_version = '2.2.11';
$db_min_version = '5.1.30';
$phpmyadmin_min_version = '3.1.1';
if (isset($GLOBALS['PMA_Config']) && version_compare($GLOBALS['PMA_Config']->get('version'), $phpmyadmin_min_version, '<')) {
    // Проверяем версии PHP, Apache, MySQL и phpMyAdmin
    if (version_compare(PHP_VERSION, $php_min_version, '<') ||
        version_compare(apache_get_version(), $apache_min_version, '<') ||
        version_compare(mysqli_get_server_info($link), $db_min_version, '<') ||
        version_compare($GLOBALS['PMA_Config']->get('version'), $phpmyadmin_min_version, '<')) {

        // Код для вывода сообщения об ошибке


        $php_version = PHP_VERSION;
        $apache_version = apache_get_version();
        $db_version = mysqli_get_server_info($link);
        $phpmyadmin_version = $GLOBALS['PMA_Config']->get('version');

        $error_message = "Предупреждение: Версия PHP, Apache, MySQL или phpMyAdmin установлена ниже, чем необходимо!\n";
        $error_message .= "Ваша версия PHP: $php_version (требуется не ниже $php_min_version)\n";
        $error_message .= "Ваша версия Apache: $apache_version (требуется не ниже $apache_min_version)\n";
        $error_message .= "Ваша версия MySQL: $db_version (требуется не ниже $db_min_version)\n";
        $error_message .= "Ваша версия phpMyAdmin: $phpmyadmin_version (требуется не ниже $phpmyadmin_min_version)\n";

        $timestamp = date('Y-m-d H:i:s');
        $log_message = "$timestamp: $error_message\n";

        // Получаем данные о браузере пользователя
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        // Формируем сообщение для записи в файл log.txt
        $log_message .= "Браузер: $user_agent\n";

        // записываем сообщение в файл
        fwrite($log_handle, $log_message);



        

    } else {
        // Если условие не выполнено, просто закрываем файл лога
        fclose($log_handle);
    }

    // Проверяем версии PHP, Apache, MySQL и phpMyAdmin на наличие более новых версий
    if (version_compare(PHP_VERSION, $php_min_version, '>') ||
        version_compare(apache_get_version(), $apache_min_version, '>') ||
        version_compare(mysqli_get_server_info($link), $db_min_version, '>') ||
        version_compare($GLOBALS['PMA_Config']->get('version'), $phpmyadmin_min_version, '>')) {

        $php_version = PHP_VERSION;
        $apache_version = apache_get_version();
        $db_version = mysqli_get_server_info($link);
        $phpmyadmin_version = $GLOBALS['PMA_Config']->get('version');

        $error_message = "Предупреждение: Версия PHP, Apache, MySQL или phpMyAdmin установлена выше, чем рекомендуется!\n";
        $error_message .= "Ваша версия PHP: $php_version (рекомендуется $php_min_version или ниже)\n";
        $error_message .= "Ваша версия Apache: $apache_version (рекомендуется $apache_min_version или ниже)\n";
        $error_message .= "Ваша версия MySQL: $db_version (рекомендуется $db_min_version или ниже)\n";
        $error_message .= "Ваша версия phpMyAdmin: $phpmyadmin_version (рекомендуется $phpmyadmin_min_version или ниже)\n";

        $timestamp = date('Y-m-d H:i:s');
        $log_message = "$timestamp: $error_message\n";

        // Получаем данные о браузере пользователя
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        // Формируем сообщение для записи в файл log.txt
        $log_message .= "Браузер: $user_agent\n";

        // записываем сообщение в файл
        fwrite($log_handle, $log_message);
    }

} else {
    // Если переменная $GLOBALS['PMA_Config'] не определена, просто закрываем файл лога
    fclose($log_handle);
}

?>
