<?php
    //start session
    session_start();
    //create constants to store non repeating values
    define('SITEURL', 'http://localhost/php/food-order/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','food-order');
    //Execute query and create an database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); 
    //database connection
    $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error());  //selecting database
    //$res = mysqli_query($conn, $sql) or die(mysqli_error());
?> 