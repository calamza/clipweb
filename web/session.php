<?php
if ($_SESSION['login_user'] == "") {
    header("location: ldap.php");
    //echo $_SESSION['login_user'];
} else {
$login_session = $_SESSION['login_user'];
// Optional full display name captured during LDAP login
$login_name = isset($_SESSION['login_name']) && $_SESSION['login_name'] !== '' ? $_SESSION['login_name'] : $login_session;
}

?>