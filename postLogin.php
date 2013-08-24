<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php
$user = $facebook->getUser();  
    
    if ($user) {
        try {
          // Proceed knowing you have a logged in user who's authenticated.
          $user_profile = $facebook->api('/me');
        } catch (FacebookApiException $e) {
          error_log($e);
          $user = null;
        }
    }
    
    if($user){
        print_r($user_profile);
        
    }
    
?>

<br>
<br>
    
<a href="fbLogout.php">Logout</a>