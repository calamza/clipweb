<?php
if ($_SESSION['login_user'] == "") {
    header("location: ldap.php");
    //echo $_SESSION['login_user'];
} else {
$login_session = $_SESSION['login_user'];
}

?>