<?php
    //starting session
    session_start();

    //Setting the constants
    define("SITEURL", 'http://localhost/second-hand/');
    define("SERVERNAME", 'localhost');
    define("USERNAME", 'jack');
    define("PASSWORD", 'jeconia');
    define("DBNAME", 'second_hand_books');
    
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME) or die('not connected');
?>