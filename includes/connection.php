<?php
    //require("constants.php");
    
    //when on localhost use localConstants
    require("localConstants.php"); 
    
    //Create database connection
    $connection = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
    if(!$connection){
        die("Database connection failed: " . mysql_error());
    }
    
    //Select database
    $db_select = mysql_select_db(DB_NAME);
    if(!$db_select){
        die("Database selection failed: " . mysql_error());
    }
?>
