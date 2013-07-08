<?php
    // Four steps to closing a session
    
    session_start(); //Finding session start
    
    // 2. Unset all the session variables
    $_SESSION = array(); // Reset all the session variables
    
    if(isset($_COOKIE[session_name()])) {
        //Destroy the session cookie
            setcookie(session_name(), '', time()-42000, '/');
    }

    session_destroy(); //Destroy the session
    
?>