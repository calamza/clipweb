<?php
//include('config.php');
$db_server="db:3306";
$db_username="ingesta_web";
$db_password="Lg3681Lg";
$db_database="ingesta_db";
$db = mysqli_connect($db_server, $db_username, $db_password,$db_database);
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
} else {

    echo "conecto bien";
}
function mostrarTexto($texto) {
    
    if (mysqli_query($db, $texto)) {
        echo "Record inserted successfully";  
    }else{  
        echo "Could not insert record: ". mysqli_error($db);  
    }
        mysqli_close($db);
    echo "<strong>El texto a mostrar es el siguiente: </strong>";

    echo $texto;

}

//echo $sql;
//echo "la conexion".$db;
/*
if(mysqli_query($db, $sql)){
    echo "Record inserted successfully";  
}else{  
    echo "Could not insert record: ". mysqli_error($db);  
}
    mysqli_close($db);
*/
/*
if (mysqli_query($db, $sql)) {
    echo "Registro creado";
} else {
    //echo "Error: " . $sql . "<br>" . mysqli_error($db);
    echo "No le pinta";
}
*/
?>