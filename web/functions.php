<?php

function save_history($texto) {
    include('config.php');
    //echo "<strong>El texto a mostrar es el siguiente: </strong>";
    //echo $texto;
    //$result = mysqli_query($db_link, "SELECT * FROM links");
    
    if (mysqli_query($db_link, $texto)) {
        echo "<h3>Link guardado en mi historial</h3>\n\n\n";  
    }else{  
        echo "Could not insert record: ". mysqli_error($db_link);  
    }
        mysqli_close($db_link);

}

function check_videoid_existance($videoid){
    
    // Creating a variable with an URL 
    // to be checked 
    $url = 'https://mediacms.unomedios.com.ar/api/v1/media/K6rS3sz4s'; 

    // Getting page header data 
    $array = @get_headers($url); 

    // Storing value at 1st position because 
    // that is only what we need to check 
    $string = $array[0]; 

    // 404 for error, 200 for no error 
    if(strpos($string, "200")) { 
    echo 'Specified URL Exists'; 
    }  
    else { 
    echo 'Specified URL does not exist'; 
    } 

    //echo "el id del video es".$videoid;

}

?>