<?php
    session_start();

    function loggedIn(){
        if(isset($_SESSION['uID'])){
            return true;
        }
        else{
            return false;   
        }
    }
    
    function confirmLoggedIn() {
        if (!loggedIn()) {
                redirect_to("login.php");
        }
    }
?>