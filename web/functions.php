<?php
include('config.php');
function save_history($texto) {
    $texto = "INSERT INTO links (descripcion) VALUES ('pruebaaa')";
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