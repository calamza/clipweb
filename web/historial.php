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
<table style="width:50%">
    <tr><td>Video ID</td><td>Link</td><td>Descripcion</td></tr>
    <?php
    $result = mysqli_query($db_link, "SELECT usuario,descripcion,link FROM links");
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          echo "<tr><td>".$row["usuario"]."</td><td>".$row["descripcion"]."</td><td>".$row["link"]. "</td></tr>";
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