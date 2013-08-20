<?php
    session_start();

    function loggedIn(){
        if(isset($_SESSION['fb_627888060569403_user_id']) || isset($_SESSION['uID'])){
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