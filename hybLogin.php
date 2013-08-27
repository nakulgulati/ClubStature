<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php

    $config   = dirname(__FILE__) . '/hybridauth/config.php';
    require_once( "hybridauth/Hybrid/Auth.php" );
    
    if(isset($_GET['provider'])){
	setReturnPath(session_id(),$_SERVER['HTTP_REFERER']);
	
        $provider_name = $_GET['provider'];
        
        try{
            // initialize Hybrid_Auth with a given file
            $hybridauth = new Hybrid_Auth( $config );

            // try to authenticate with the selected provider
            $adapter = $hybridauth->authenticate( $provider_name );

            // then grab the user profile 
            $userProfile = $adapter->getUserProfile();
        }
        catch( Exception $e ){
        }
	global $userProfile;
        $userExists = socialUserExists($provider_name,$userProfile->identifier);
	$urlSet = getData("returnPath","*","sessionID",session_id());
	$url = mysql_fetch_array($urlSet);
        if($userExists){
            
            updateAvatar($userProfile->identifier,$userProfile->photoURL);
            $userSet = getData("users","*","uID",$userProfile->identifier);
            $user = mysql_fetch_array($userSet);
            
            $_SESSION['uID'] = $user['uID'];
            $_SESSION['provider'] = $provider_name;
	    
	    redirect_to($url['returnURL']);

        }
        else{
            createSocialUser($provider_name,$userProfile->identifier,$userProfile->displayName,$userProfile->email,$userProfile->photoURL);
            $_SESSION['uID'] = $userProfile->identifier;
            $_SESSION['provider'] = $provider_name;

	    redirect_to($url['returnURL']);
        }
    }

?>

<?php ob_end_flush(); ?>