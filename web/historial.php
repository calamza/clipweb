<?php
#Iniciar sesion
session_start();
include('ldap.php');
include('session.php');
include('config.php');
include('functions.php');
$filtro = $_GET['filtro'];
$users = $_GET['users'];
if (isset($users)) {
  //echo "tiene algo";
} else {
  $users= NULL;
}
echo $login_session;
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>ClipWEB - Cortar videos para compartir</title>

</head>
<body>
<h2><a href="index.php">Ir al home</a></h2>
<h2>Historico de links creados por <?php echo $login_session; ?></h2>

<p>
</br></br>
<a href="historial.php"> Mostrar todos </a></br>
<a href="historial.php?filtro=activos"> Mostrar solo links activos </a></br>
<a href="historial.php?filtro=vencidos"> Mostrar solo links vencidos </a></br>

<table style="width:100%">
    <h3><tr><td>Descripcion</td><td>Link</td><td>Link Video Original</td><td>Tiempo de inicio del video original</td><td>Tiempo fin del video original</td></tr></h3>
    <?php
    
    if ($users == NULL) {
      //$select = "SELECT usuario,descripcion,link,videoid,inicio,fin FROM links WHERE usuario=$_SESSION['login_user']";
      //$result = mysqli_query($db_link, "SELECT usuario,descripcion,link,videoid,inicio,fin FROM links WHERE usuario=$_SESSION['login_user']");
    } else {
      $select = "SELECT usuario,descripcion,link,videoid,inicio,fin FROM links";
      //$result = mysqli_query($db_link, "SELECT usuario,descripcion,link,videoid,inicio,fin FROM links");
    }
    
    $result = mysqli_query($db_link, "SELECT usuario,descripcion,link,videoid,inicio,fin FROM links");
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          //check_clip_existance($row["link"]);
          if (check_clip_existance($row["link"]) == 1) {
            if ($filtro == "activos" or $filtro == NULL) {
              $link_download="https://clipcms.unomedios.com.ar/".$row["link"];
              echo "<tr><td>".$row["descripcion"]."</td><td><a href='".$link_download. "'>Descargar clip</a></td><td><a href='https://mediacms.unomedios.com.ar/view?m=".$row["videoid"]."'>Ir al original</a></td><td>".$row["inicio"]. "</td><td>".$row["fin"]. "</td></tr>";
            }
          } else {
            if ($filtro == "vencidos" or $filtro == NULL) {
              $link_download="https://clipcms.unomedios.com.ar/".$row["link"];
              echo "<tr><td>".$row["descripcion"]."</td><td><p>Link vencido!!</p></td><td><a href='https://mediacms.unomedios.com.ar/view?m=".$row["videoid"]."'>Ir al original</a></td><td>".$row["inicio"]. "</td><td>".$row["fin"]. "</td></tr>";
            }
          }
        }
      } else {
        echo "Sin resultados";
      }
    
    ?>
    
</table>
</p>

<h3><a href="docu.html">Guia del usuario</a></h3>
<h3><a href="logout.php">Cerrar sesion</a></h3>

</body>
</html>