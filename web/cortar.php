<?php
include('ldap.php');
include('config.php');
ob_start();
$videoid = $_POST['videoid'];
$inicio = $_POST['inicio'];
$fin = $_POST['fin'];
$permanente = $_POST['permanente'];
$descripcion = $_POST['descripcion'];

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>ClipWEB - Cortar videos para compartir</title>

</head>
<body>

<table>
     
<?php

shell_exec("curl -k 'https://mediacms.unomedios.com.ar/api/v1/media/".$videoid."' --header 'accept: application/json' --header 'X-CSRFToken: uKIFnweHqLCM2hbosUOYAconmI3Pr3Tx6nKGIIMlC3tzKILiavLGiozVt7Zb3wP9' --header 'Authorization: Basic TWVkaWFDTVM6TGczNjgxTGc=' > tmp.json");

$tmp_json = file_get_contents('tmp.json');
$decoded_json = json_decode($tmp_json, true);


$encodings_info = $decoded_json['encodings_info'];
$temp_original=$encodings_info['0-original'];
$temp_original2=$temp_original['h264'];
$url_original=$temp_original2['url'];

## Comprueba si el archivo existe para no tener que volver a descargarlo
$filename = 'downloads/'.$videoid.'.mp4';
if (file_exists($filename)) {
    echo "<tr><td colspan='2'>Archivo original de video en cache, generacion rapida de clip</td></tr>";
} else {
    //echo "The file $filename does not exist";
    echo "<tr><td colspan='2'>El archivo original de video ahora esta en cache, generacion rapida de clips de este video disponible por 2 horas</td></tr>";
    shell_exec("wget --no-use-server-timestamps -O downloads/".$videoid.".mp4 https://mediacms.unomedios.com.ar".$url_original);
}

## Guardado clip
$randomID=uniqid();
if ($permanente==0) {
    shell_exec("ffmpeg -i downloads/".$videoid.".mp4  -ss ".$inicio." -to ".$fin." -c:v copy -c:a copy clips/clip-".$videoid."-".$randomID.".mp4");
?>
    <tr><td>  <?php echo "https://clipcms.unomedios.com.ar/clips/clip-".$videoid."-".$randomID.".mp4  "; ?></td> 
    <td><a href='download.php?url=<?php echo "clips/clip-".$videoid."-".$randomID.".mp4"; ?> '> Descargar clip </a></tr></td></br></br></br>
<?php
    $sql = "INSERT INTO descripcion (id, usuario, descripcion, link) VALUES ('', $login_session, $descripcion, 'download.php?url=clips/clip-.$videoid.$randomID.mp4')";
    if (mysqli_query($db, $sql)) {
        echo "Registro creado";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
      }
} else {
    shell_exec("ffmpeg -i downloads/".$videoid.".mp4  -ss ".$inicio." -to ".$fin." -c:v copy -c:a copy clips-permanentes/clip-".$videoid."-".$randomID.".mp4");
?>
    <tr><td>  <?php echo "https://clipcms.unomedios.com.ar/clips-permanentes/clip-".$videoid."-".$randomID.".mp4  "; ?></td> 
    <td><a href='download.php?url=<?php echo "clips-permanentes/clip-".$videoid."-".$randomID.".mp4"; ?> '> Descargar clip </a></tr></td></br></br></br>
<?php
}
?>
    
</table>
</br></br></br></br></br></br>
    <h2><a href = "index.php">Volver</a></h2></br>
    <h2><a href = "logout.php">Sign Out</a></h2>
</body>

</html>

<?php

## comando para buscar archivos con mas de 1 hora de antiguedad
#find ../downloads/ -type f -mtime +0.05
## Borrar el json al dope
shell_exec("rm -f tmp.json");
?>