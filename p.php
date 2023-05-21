<?
if (isset($_SESSION['status']) && $_SESSION['status'] == 1) {
function getUsers()
{
    global $link;
    $query = "SELECT * FROM users WHERE status != 1";
    $result = mysqli_query($link, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $users;
    }
    return array();
}
}else{
     echo '<script>window.location.href = "main.php";</script>';
     exit;
}
?>