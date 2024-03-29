<?php
   /*
   define('DB_SERVER', 'db:3306');
   define('DB_USERNAME', 'ingesta_web');
   define('DB_PASSWORD', 'Lg3681Lg');
   define('DB_DATABASE', 'ingesta_db');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   */
   $db_server="db:3306";
   $db_username="ingesta_web";
   $db_password="Lg3681Lg";
   $db_database="ingesta_db";
   $db_link=mysqli_connect($db_server, $db_username, $db_password,$db_database);
   if($db_link = false) {
      die("Error: " . mysqli_error_connect());
   }    

?>