<?php
//include('config.php');



function save_history($texto) {
    $texto = "INSERT INTO links (descripcion) VALUES ('pruebaaa')";
    //$texto = "INSERT INTO links (usuario, description) value (javier, kalkakakaka)";
    include('config.php');
    echo "<strong>El texto a mostrar es el siguiente: </strong>";
    echo $texto;
    $result = mysqli_query($db_link, "SELECT * FROM links");
    
    if (mysqli_query($db_link, $texto)) {
        echo "Record inserted successfully";  
    }else{  
        echo "Could not insert record: ". mysqli_error($db_link);  
    }
        mysqli_close($db_link);

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