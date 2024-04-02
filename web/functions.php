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
    $url = "https://mediacms.unomedios.com.ar/api/v1/media/".$videoid; 

    // Getting page header data 
    $array = @get_headers($url); 

    // Storing value at 1st position because 
    // that is only what we need to check 
    $string = $array[0]; 

    // 404 for error, 200 for no error 
    if(strpos($string, "200")) { 
        return 1; 
    } else { 
        return 0; 
    } 

    //echo "el id del video es".$videoid;

}

function check_clip_existance($url){
    
    // Creating a variable with an URL 
    // to be checked

    $url = "https://clipcms.unomedios.com.ar/".substr($url,17);
    echo $url;
    // Getting page header data 
    //$array = @get_headers($url); 

    // Storing value at 1st position because 
    // that is only what we need to check 
    //$string = $array[0]; 

    // 404 for error, 200 for no error 
    /*
    if(strpos($string, "200")) { 
        return 1; 
    } else { 
        return 0; 
    } 
    */

}

?>