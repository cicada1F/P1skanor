<?php

require_once 'login.php';

if (isset($_GET['user_id'])) {
    $user_id = mysqli_real_escape_string($link, $_GET['user_id']);
    $tema_query = mysqli_query($link, "SELECT id, tema, user_id, helpa FROM help WHERE user_id='$user_id'");
    $tema_options = '';
    while ($tema_row = mysqli_fetch_assoc($tema_query)) {
        $tema_options .= "<option value='{$tema_row['id']}'>{$tema_row['tema']} (от {$tema_row['user_id']})</option>";
    }
    echo $tema_options;
}
?>
