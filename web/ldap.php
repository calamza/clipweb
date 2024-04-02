<?php
/**
 * Created by Joe of ExchangeCore.com
 */
//include('functions.php');
session_start();
if(isset($_POST['username']) && isset($_POST['password'])){

    $adServer = "ldap://unomedios.com.ar";

    $ldap = ldap_connect($adServer);
    $username = $_POST['username'];
    $password = $_POST['password'];

    $ldaprdn = 'unomedios' . "\\" . $username;

    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

    $bind = @ldap_bind($ldap, $ldaprdn, $password);

    if ($bind) {
        $filter="(sAMAccountName=$username)";
        $result = ldap_search($ldap,"dc=unomedios,dc=com,dc=ar",$filter,array("memberof"));
        //ldap_sort($ldap,$result,"sn");
        $info = ldap_get_entries($ldap, $result);
        //echo "Existe el usuario";
        
        for ($i=0; $i<$info["count"]; $i++)
        {
            if($info['count'] > 1)
                break;
            //echo "<p>You are accessing <strong> ". $info[$i]["memberof"][1] .", " . $info[$i]["givenname"][0] ."</strong><br /> (" . $info[$i]["samaccountname"][0] .")</p>\n";
            $groups_count=count($info[$i],1);
            //echo $groups_count;
            
            for ($j=0; $j<$groups_count; $j++)
            {
                //echo "<p>dentro del segundo for</p>\n".$j;
                //echo $info[$i]["memberof"][$j];
                if ($info[$i]["memberof"][$j] == "CN=G_ClipWeb,OU=Grupos_Medios,OU=Medios,DC=unomedios,DC=com,DC=ar") {
                    $userok=1;
                }
            }
        }
        
        @ldap_close($ldap);
    } else {
        $msg = "Usuario y/o clave incorrecto";
        echo $msg;
    }
    if ($userok==1) {
        //echo "acceso concedido.";
        $_SESSION['login_user'] = $username;
        /*
        if (check_if_admin($username) == 1) {
            $_SESSION['admin_user'] = 1;
            //echo $_SESSION['admin_user'];
        } else {
            $_SESSION['admin_user'] = 0;
            //echo $_SESSION['admin_user'];
        }
        */
        header("location:index.php");
    } else {
        echo "el usuario no tiene permiso para ingresar, debe solicitar permiso al sector de soporte para habilitar el acceso.";
    }
    

}else{
if ($_SESSION['login_user'] == NULL )
{
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>ClipWEB - Iniciar sesion</title>
</head>
<body>
<p><h2>Iniciar sesion con su usuario de la compu (apellido.nombre)</h2></p></br>
<p><h3>IMPORTANTE: Si no has ingresado nunca y tu usuario no esta habilitado contacta con el equipo de soporte para poder acceder.</h3></p>
</br></br>
    <table style="width:100%">
    
    <form action="#" method="POST">
    <p>
    <tr><td><label for="username">Nombre de usuario: </label><input id="username" type="text" name="username" /></td></tr>
    <tr><td><label for="password">Clave: </label><input id="password" type="password" name="password" /> </td></tr>
    <tr><td><input type="submit" name="submit" value="Iniciar sesion" /></td></tr>
    </p>
    </form>
    </table>
</body>
</html>
<?php } } ?> 