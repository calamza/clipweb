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
    
    echo shell_exec("curl --write-out %{http_code} --silent --output /dev/null -X -k 'GET' 'https://mediacms.unomedios.com.ar/api/v1/media/K6rS3lz4s'-H 'accept: application/json' -H 'X-CSRFToken: iUyvDbVpdYP4sGuBzSqDwCaAX0SJMqAOUxAwYnt3pgGRa74vhtnleOl84pO5oTwq'");
    /*
    RESPONSE=$(curl --write-out %{http_code} --silent --output /dev/null ${URL})
    if [ $RESPONSE -ne 200 ]
    then
        echo $1 is down
    fi
    */
    echo "el id del video es".$videoid;

}

?>