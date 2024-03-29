<?php

function save_history($texto) {
    include('config.php');
    //echo "<strong>El texto a mostrar es el siguiente: </strong>";
    //echo $texto;
    //$result = mysqli_query($db_link, "SELECT * FROM links");
    
    if (mysqli_query($db_link, $texto)) {
        echo "<strong>Link guardado en mi historial</strong>\n\n\n";  
    }else{  
        echo "Could not insert record: ". mysqli_error($db_link);  
    }
        mysqli_close($db_link);

}

?>