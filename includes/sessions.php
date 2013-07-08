<?php
    session_start();

    function loggedIn(){
        return isset($_SESSION['userId']);
    }
    
    function confirmLoggedIn() {
        if (!loggedIn()) {
                redirect_to("login.php");
        }
    }
?>