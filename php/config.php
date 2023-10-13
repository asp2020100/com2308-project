<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'demo1');
define('DB_PASSWORD', 'demo4840');
define('DB_NAME', 'demo1');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>