<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php
    $uID = $facebook->getUser();
    
    $urlSet = getData("returnPath","*","sessionID",session_id());
    $url = mysql_fetch_array($urlSet);
    
    if($uID){
        try{
            // Proceed knowing you have a logged in user who's authenticated.
            $userProfile = $facebook->api('/me');
        }catch (FacebookApiException $e){
            error_log($e);
            $uID = null;
        }
    }
    
       
    if($uID){
        $userExists = socialUserExists("Facebook",$uID);
        if($userExists){
            $userSet = getData("users","*","uID",$uID);
            $user = mysql_fetch_array($userSet);
            
            $_SESSION['uID'] = $uID;
            $_SESSION['provider'] = "Facebook";
            redirect_to($url['returnURL']);
        }
        else{
            $avatar = "https://graph.facebook.com/{$uID}/picture";
            if(!isset($userProfile['email'])){
                $userProfile['email'] = "";
            }
            createSocialUser("Facebook",$uID,$userProfile['name'],$userProfile['email'],$avatar);
            
            $_SESSION['uID'] = $uID;
            $_SESSION['provider'] = "Facebook";
            
            redirect_to($url['returnURL']);
            
        }
    }
?>