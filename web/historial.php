<?php
#Iniciar sesion
include('ldap.php');
include('session.php');

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>ClipWEB - Cortar videos para compartir</title>

</head>
<body>
<h1>Historico de links creados por <?php echo $login_session; ?></h1>
<p>
<table style="width:50%">
    <tr><td>Video ID</td></tr>
    <tr><td>Link</td></tr>
    <tr><td>Descripcion</td></tr>
</table>
</p>
<h3><a href="index.php">Ir al home</a></h3>
<h3><a href="docu.html">Guia del usuario</a></h3>
<h3><a href="logout.php">Cerrar sesion</a></h3>

</body>
</html>