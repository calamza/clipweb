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
<body class="" style="background:#f3f6fb;">
  <div class="container">
    <div class="card">
      <img src="images/videoid.png" alt="ClipWEB" style="height:42px;display:block;margin:0 auto 8px;opacity:.9">
      <h1 style="text-align:center;">Bienvenido <?php echo htmlspecialchars($login_session); ?></h1>
      <p class="muted" style="text-align:center;margin:0 0 12px;">Generá y compartí clips fácilmente</p>
<?php
if ($_SESSION['videoID']==NULL) {
  #echo $_SESSION['videoID'];
  if ($_SESSION['admin_user'] == 1) {
?>
    <p style="text-align:center" class="alert alert-info"><a href="historial.php?users=todos">Historial de todos los usuarios</a> (solo admins)</p>
<?php
}?>
<form action="cortar.php" method="post" class="" style="max-width:720px;margin:16px auto;">
  <h2>Identificar video</h2>
  <label>VideoID</label>
  <input type="text" name="videoid" pattern="[a-zA-Z0-9]{9}" placeholder="Ej: ABCDE1234" required>
  <small class="muted">ID del video en MediaCMS (lo que figura en la URL después de =)</small>
  <label>Inicio</label>
  <input type="text" name="inicio" placeholder="00:00:00">
  <label>Fin</label>
  <input type="text" name="fin" placeholder="00:00:00">
  <label>Descripción</label>
  <input type="text" id="name" name="descripcion" required minlength="4" maxlength="50">
  <label style="display:flex;align-items:center;gap:8px"><input type="checkbox" name="permanente" value="checkox_value"> Clip en línea por 6 meses</label>
  <div class="alert alert-warn"><strong>Aviso:</strong> si no tildás “Clip en línea por 6 meses”, el clip queda 30 días.</div>
  <div class="alert alert-err"><strong>Importante:</strong> al presionar “Cortar” comienza el procesamiento; no hagas clic varias veces.</div>
  <input type="submit" value="Cortar" class="btn">
</form>
</br></br>
<div style="text-align:center">
  <p><a href="docu.html">Guía del usuario</a> · <a href="historial.php">Ver mis links</a> · <a href="logout.php">Cerrar sesión</a></p>
  <p class="muted">Soporte: <a href="mailto:soporte@grupoamerica.com.ar">soporte@grupoamerica.com.ar</a></p>
</div>
<?php
include_once('footer.php');
}

// remove all session variables
#session_unset();

// destroy the session
#session_destroy();
?>
    </div>
  </div>
  </div>
<script src="version.php"></script>
<script src="footer.js"></script>
</body>
</html>