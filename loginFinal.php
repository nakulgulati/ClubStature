<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php

    $config   = dirname(__FILE__) . '/hybridauth/config.php';
    require_once( "hybridauth/Hybrid/Auth.php" );

    function socialUserExists($provider,$uID){
        global $connection;
        
        $query = "SELECT * FROM  `users` WHERE  `provider` =  '{$provider}' &&  `uID` =  '{$uID}'";
        $resultSet = mysql_query($query,$connection);
        
        if(mysql_num_rows($resultSet)==1){
            return true;
        }
        else{
            return false;
        }
    }
    
    function createSocialUser($provider,$uID,$name,$email,$avatar){
        global $connection;
	
	$query = "INSERT INTO `users`(`provider`, `uID`, `displayName`, `email`, `avatar`) VALUES ('{$provider}','{$uID}','{$name}','{$email}','{$avatar}');";
	mysql_query($query,$connection);
    }
    
    function updateAvatar($uID,$avatar){
	global $connection;
	
	$query = "UPDATE `users` SET avatar = '{$avatar}' WHERE uID = {$uID};";
	mysql_query($query,$connection);
    }
    
    
    if(isset($_GET['provider'])){
        if($_GET['provider'] == "Facebook"){
            $url = $_SERVER['HTTP_REFERER'];
        }
        global $url;
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
        if($userExists){
            
            updateAvatar($userProfile->identifier,$userProfile->photoURL);
            $userSet = getData("users","*","uID",$userProfile->identifier);
            $user = mysql_fetch_array($userSet);
            
            $_SESSION['uID'] = $user['uID'];
            $_SESSION['provider'] = $provider_name;
            
            redirect_to($url);

        }
        else{
            createSocialUser($provider_name,$userProfile->identifier,$userProfile->displayName,$userProfile->email,$userProfile->photoURL);
            $_SESSION['uID'] = $userProfile->identifier;
            $_SESSION['provider'] = $provider_name;
            redirect_to($url);
        }
    }

?>

<?php mysql_close($connection); ?>
<?php ob_end_flush(); ?>