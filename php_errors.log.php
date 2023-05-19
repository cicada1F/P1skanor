<?php
$log_file = 'php_errors_log.txt';

function custom_error_handler($errno, $errstr, $errfile, $errline) 
{
    global $log_file;

    // преобразуем типы ошибок в строки для удобства чтения логов
    $error_types = array
    (
        E_ERROR => 'E_ERROR',
        E_WARNING => 'E_WARNING',
        E_PARSE => 'E_PARSE',
        E_NOTICE => 'E_NOTICE',
        E_CORE_ERROR => 'E_CORE_ERROR',
        E_CORE_WARNING => 'E_CORE_WARNING',
        E_COMPILE_ERROR => 'E_COMPILE_ERROR',
        E_COMPILE_WARNING => 'E_COMPILE_WARNING',
        E_USER_ERROR => 'E_USER_ERROR',
        E_USER_WARNING => 'E_USER_WARNING',
        E_USER_NOTICE => 'E_USER_NOTICE',
        E_STRICT => 'E_STRICT',
        E_RECOVERABLE_ERROR => 'E_RECOVERABLE_ERROR',
        8192 => 'E_DEPRECATED',
        16384 => 'E_USER_DEPRECATED'
    );

    $timestamp = date('Y-m-d H:i:s');
    $log_message = "$timestamp: {$error_types[$errno]}: $errstr in $errfile:$errline\n";
    file_put_contents($log_file, $log_message, FILE_APPEND | LOCK_EX);
}

set_error_handler("custom_error_handler");

?>
