<?php
session_start();
## Check host referer
if($_SERVER['HTTP_REFERER'] == "https://mediacms.unomedios.com.ar/") {
  $_SESSION['login_user'] = "MediaCMS";
  #echo $_SERVER['HTTP_REFERER'];
  #header("location: index.php");
}
## Muestra panel admin
//echo "El tipo de usuario es ".$_SESSION['admin_user'];

#Iniciar sesion
include('ldap.php');
include('session.php');
$error = $_GET['error'];
if ($error == "videoid") {
  echo "<h5>Error en el id del VideoID, por favor verifique y vuelva a intentar</h5>";
}

if (isset($_SESSION['videoID'])) {
  #echo "Variable 'paso1' is set.";
} else {
  #echo "no esta definida la variable";
  $_SESSION['videoID']= NULL;
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>ClipWEB - Cortar videos para compartir</title>

</head>
<body>
<h1>Bienvenido <?php echo $login_session; ?></h1>
<p>
<?php
if ($_SESSION['videoID']==NULL) {
  #echo $_SESSION['videoID'];
  if ($_SESSION['admin_user'] == 1) {
?>
    <p align="center"><a href="historial.php?users=todos"> Historial de todos los usuarios </a> (vista solo para admins)</p></br>
<?php
}?>
<form action="cortar.php" method="post">
<fieldset>
<!-- Form Name -->
<h3>Identificar video</h3>
<!-- Text input-->

  <table style="width:50%">
    <tr><td>VideoID<input type="text" name="videoid" pattern="[a-zA-Z0-9]{9}"> ID del video de mediacms, es lo que figura en la url despues del signo =</td></tr>
    <tr><td>Inicio<input type="text" name="inicio" placeholder="00:00:00" > en formato hora 01:02:03, hora, minuto y segundo en el que debe empezar respecto al original</td></tr>
    <tr><td>Fin<input type="text" name="fin" placeholder="00:00:00"> en formato hora 01:02:03, hora, minuto y segundo en el que debe finalizar respecto al original</td></tr>
    <tr><td>Descripcion<input type="text" id="name" name="descripcion" required minlength="4" maxlength="50" size="80" /></td></tr>
    <tr><td>Clip en linea por 6 meses<input type="checkbox" name="permanente" value="checkox_value"></td></tr>
  </table>
  <bold><p style="color:#FF0000">AVISO: Si no se selecciona el tilde "Clip en linea por 6 meses", el clip solo va a estar disponible en linea por 30 dias<p></bold>
  <bold><p style="color:#FF0000">IMPORTANTE: Cuando le de al boton cortar se va a procesar el clip por lo que va a demorar. NO PRESIONE VARIAS VECES EL BOTON CORTAR!!<p></bold>
  <input type="submit" value="Cortar">
  </fieldset>
</form>
</br></br>
<h3><a href="docu.html">Guia del usuario</a></h3>
<h3><a href="historial.php">Ver mis links generados</a></h3>
<h3><a href="logout.php">Cerrar sesion</a></h3>
<?php
include_once('footer.php');
}

// remove all session variables
#session_unset();

// destroy the session
#session_destroy();
?>
</body>
</html>