<?php
include('config.php');
function save_history($texto) {
    $texto = "INSERT INTO links ('descripcion') VALUES ('pruebaaa')";
    
    $result = mysqli_query($db, $texto);
    print_r($result);
    die("waiting...");
    if ($result === false) {
        printf("error: %s\n", mysqli_error($db));
        return 0;
    }
    /*
    if ( false===$result ) {
        printf("error: %s\n", mysqli_error($db));
    } else {
        echo 'done.';
    }
    */
    /*
    if (mysqli_query($db, $texto)) {
        echo "Record inserted successfully";  
    }else{  
        echo "Could not insert record: ". mysqli_error($db);  
    }
        mysqli_close($db);
    */
    
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