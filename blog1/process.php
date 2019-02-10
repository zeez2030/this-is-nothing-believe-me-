<?php 
include 'config/config.php';
include 'classes/database.php';
include 'helpers/format_helper.php';
$db = new Database;
$logout = $_GET['logout'];
$login = $_GET['login'];

if ($logout == 'true') {
    session_destroy();
    header("Location:index2.php");
}
if ($login == 'true') {
    header("Location:index2.php");
}

if (isset($_POST['submit'])) {
    $query = "SELECT * from users where email = '" . $_POST['email'] . "' and
    password='" . $_POST['password'] . "' ;";
    $result = $db->get_query_result($query);
    if ($result) {
        $user = $result->fetch_assoc();
        $_SESSION['user_name'] = $user['user_name'];
        $_SESSION['password'] = $user['password'];
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['login'] = true;
        header("Location:index.php");
    } else {
        header(" Location : index2 . php ? message = wrong user information ");
    }



} else {
    header('Location:index2.php');
}


?>