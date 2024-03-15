<?php

#Iniciar sesion
include('session.php');
if($_SERVER['HTTP_REFERER'] == "https://mediacms.unomedios.com.ar/ ") {
  $_SESSION['login_user'] = "MediaCMS";
  echo $_SERVER['HTTP_REFERER'];
  header("location: index.php");
} else {
  echo "no entro";

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
<title>ClipWEB - Cortar videos para compartir</title>

</head>
<body>
<h1>Bienvenido <?php echo $login_session; ?></h1>
<p>
<?php
if ($_SESSION['videoID']==NULL) {
  #echo $_SESSION['videoID'];
?>

<form action="cortar.php" method="post">
<fieldset>
<!-- Form Name -->
<legend>Identificar video</legend>
<!-- Text input-->

  <table style="width:50%">
    <tr><td>VideoID<input type="text" name="videoid" pattern="[a-zA-Z0-9]{9}"> ID del video de mediacms, es lo que figura en la url despues del signo =</td></tr>
    <tr><td>Inicio<input type="text" name="inicio" placeholder="00:00:00" pattern="[0-2]{2}:[0-59]{2}:[0-59]{2}"> en formato hora 01:02:03, hora, minuto y segundo en el que debe empezar respecto al original</td></tr>
    <tr><td>Fin<input type="text" name="fin" placeholder="00:00:00" pattern="[0-2]{2}:[0-59]{2}:[0-59]{2}"> en formato hora 01:02:03, hora, minuto y segundo en el que debe finalizar respecto al original</td></tr>
    <tr><td>Clip en linea por 6 meses<input type="checkbox" name="permanente" value="checkox_value"></td></tr>
  </table>
  <bold><p style="color:#FF0000">AVISO: Si no se selecciona el tilde "Clip en linea por 6 meses, el clip solo va a estar disponible en linea por 30 dias"<p></bold>
  <bold><p style="color:#FF0000">IMPORTANTE: Cuando le de al boton cortar se va a procesar el clip por lo que va a demorar. NO PRESIONE VARIAS VECES EL BOTON CORTAR!!<p></bold>
  <input type="submit" value="Cortar">
  </fieldset>
</form>
</br></br>
<h3><a href = "logout.php">Sign Out</a></h3>
<?php
}

// remove all session variables
#session_unset();

// destroy the session
#session_destroy();
?>
</body>
</html>