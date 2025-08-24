<?php

function save_history($sqlInsertOrText) {
    include('config.php');
    // Only allow INSERT statements for safety
    if (stripos(trim($sqlInsertOrText), 'insert') !== 0) {
        return false;
    }
    $ok = mysqli_query($db_link, $sqlInsertOrText) === true;
    if (!$ok) {
        error_log('save_history error: ' . mysqli_error($db_link));
    }
    mysqli_close($db_link);
    return $ok;
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
    //echo $url;
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

}

function check_if_admin($username) {
    include('config.php');
    $isAdmin = 0;
    if ($result_select = mysqli_query($db_link, "SELECT username FROM admin")) {
        while($row = mysqli_fetch_assoc($result_select)) {
            if (isset($row["username"]) && strcasecmp($row["username"], $username) === 0) {
                $isAdmin = 1; break;
            }
        }
        mysqli_free_result($result_select);
    }
    return $isAdmin;

}

?>