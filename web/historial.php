<?php
#Iniciar sesion
include('ldap.php');
include('session.php');
include('config.php');
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>ClipWEB - Cortar videos para compartir</title>

</head>
<body>
<h2>Historico de links creados por <?php echo $login_session; ?></h2>
<p>
</br></br>
<table style="width:100%">
    <h3><tr><td>Descripcion</td><td>Link</td><td>Link Video Original</td><td>Tiempo de inicio del video original</td><td>Tiempo fin del video original</td></tr></h3>
    <?php
    $result = mysqli_query($db_link, "SELECT usuario,descripcion,link,videoid,inicio,fin FROM links");
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          $link_download="https://clipcms.unomedios.com.ar/".$row["link"];
          echo "<tr><td>".$row["descripcion"]."</td><td><a href='".$link_download. "'>Descargar clip</a></td><td><a href='https://mediacms.unomedios.com.ar/view?m=".$row["videoid"]."'>Ir al original</a></td><td>".$row["inicio"]. "</td><td>".$row["fin"]. "</td></tr>";
        }
      } else {
        echo "0 results";
      }
    ?>
    
</table>
</p>
<h3><a href="index.php">Ir al home</a></h3>
<h3><a href="docu.html">Guia del usuario</a></h3>
<h3><a href="logout.php">Cerrar sesion</a></h3>

</body>
</html>