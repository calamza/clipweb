<?php

session_start();
include('config.php');
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
        # Chequeamos si es admin
        $result_select = mysqli_query($db_link, "SELECT username FROM admin");
        if (mysqli_num_rows($result_select) > 0) {
            while($row = mysqli_fetch_assoc($result_select)) {
                if ($row["username"] == $username) {
                    $_SESSION['admin_user'] = 1;
                }
            }
        }
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
<title>ClipWEB - Iniciar sesión</title>
</head>
<body class="layout-center">
    <div class="card" style="width:480px;max-width:90vw">
        <img src="images/videoid.png" alt="ClipWEB" style="height:42px;display:block;margin:0 auto 8px;opacity:.9">
        <h1 style="text-align:center">Iniciar sesión</h1>
        <p class="muted" style="text-align:center">Usá tu usuario corporativo (apellido.nombre)</p>
        <form action="#" method="POST">
            <label for="username">Nombre de usuario</label>
            <input id="username" type="text" name="username" required />
            <label for="password">Clave</label>
            <input id="password" type="password" name="password" required />
            <input type="submit" name="submit" value="Iniciar sesión" class="btn" />
        </form>
        <div class="alert alert-info">Si no estás habilitado, contactá a <a href="mailto:soporte@grupoamerica.com.ar">soporte</a>.</div>
        <footer>
            <div class="muted">ClipWEB · Grupo América</div>
        </footer>
    </div>
</body>
</html>
<?php } } ?> 