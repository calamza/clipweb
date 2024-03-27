<?php
$username = $_POST['username'];
$password = $_POST['password'];

$ldapuser = "S_clipcms";
$ldappass = "V2awy3oLBT";
$ldapconfig['host'] = "unomedios.com.ar";//CHANGE THIS TO THE CORRECT LDAP SERVER
$ldapconfig['port'] = "389";
$ldapconfig['basedn'] = "DC=unomedios,DC=com,DC=ar";//CHANGE THIS TO THE CORRECT BASE DN
$ldapconfig['usersdn'] = "OU=Servicios,OU=Medios";//CHANGE THIS TO THE CORRECT USER OU/CN
$ds=ldap_connect($ldapconfig['host'], $ldapconfig['port']);

ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
ldap_set_option($ds, LDAP_OPT_NETWORK_TIMEOUT, 10);

$dn="CN=".$ldapuser.",".$ldapconfig['usersdn'].",".$ldapconfig['basedn'];
if(isset($_POST['username'])){
if ($bind=ldap_bind($ds, $dn, $ldappass)) {
  echo("Conectado");//REPLACE THIS WITH THE CORRECT FUNCTION LIKE A REDIRECT;
  $search = ldap_search($ds, "sAMAccountName=".$username.",DC=unomedios,DC=com,DC=ar", "(cn=*)");
  echo $search;
} else {
 echo "Error de conexion al Active Directory";
}
}
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<form action="" method="post">
<input name="username">
<input type="password" name="password">
<input type="submit" value="Submit">
</form>
</body>
</html>