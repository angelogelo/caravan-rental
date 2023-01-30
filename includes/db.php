<?php
    //error_reporting(0);
    /* Database credentials. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'u847377087_caravan_rental');
    define('DB_PASSWORD', '9*cq3>X64J:x');
    define('DB_NAME', 'u847377087_caravan_rental');
     
    /* Attempt to connect to MySQL database */
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
     
    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    
//     $host = "localhost";
// 	$username = "u847377087_caravan_rental";
//  	$password = "9*cq3>X64J:x";
// 	$database = "u847377087_caravan_rental";
?>