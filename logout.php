<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php
    $param = array("next" => $_SERVER['HTTP_REFERER']);
    $logoutUrl = $facebook->getLogoutUrl($param);
    
    deleteReturnPath(session_id());
    
    session_start(); //Finding session start
    
    // 2. Unset all the session variables
    $_SESSION = array(); // Reset all the session variables
    
    if(isset($_COOKIE[session_name()])) {
        //Destroy the session cookie
            setcookie(session_name(), '', time()-42000, '/');
    }

    session_destroy(); //Destroy the session
    
    
    redirect_to($logoutUrl);

?>