<?php
/**
 * Created by Joe of ExchangeCore.com
 */
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
        echo "Existe el usuario";
        echo count($info,1);
        for ($i=0; $i<$info["count"]; $i++)
        {
            if($info['count'] > 1)
                break;
            //echo "<p>You are accessing <strong> ". $info[$i]["memberof"][1] .", " . $info[$i]["givenname"][0] ."</strong><br /> (" . $info[$i]["samaccountname"][0] .")</p>\n";
           
            for ($j=0; $j<$info["count"]; $j++)
            {
                echo "<p>dentro del segundo for</p>\n";
                
            }
            echo $info[$i]["memberof"][2];
            echo "esta dentro del primer for";
            echo '<pre>';
            //var_dump($info);
            echo '</pre>';
            $userDn = $info[$i]["distinguishedname"][0]; 
        }
        
        @ldap_close($ldap);
    } else {
        $msg = "Usuario y/o clave incorrecto";
        echo $msg;
    }

}else{
?>
    <form action="#" method="POST">
        <label for="username">Username: </label><input id="username" type="text" name="username" /> 
        <label for="password">Password: </label><input id="password" type="password" name="password" />        <input type="submit" name="submit" value="Submit" />
    </form>
<?php } ?> 