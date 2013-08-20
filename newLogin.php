<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>



<?php
    if(!isset($_GET['provider'])){
    
    if(strpos($_SERVER['HTTP_REFERER'],"signup.php")){
	$_SESSION['url'] = "index.php";
    }
    else{
	$_SESSION['url'] = $_SERVER['HTTP_REFERER'];
    }
    }	


    $config   = dirname(__FILE__) . '/hybridauth/config.php';
    require_once( "hybridauth/Hybrid/Auth.php" );
    
    function authUser($username,$password){
        global $connection;
        
        $password = sha1($password);
        $query = "SELECT * FROM  `users` WHERE  `username` =  '{$username}' &&  `hashedPass` =  '{$password}'";
        $resultSet = mysql_query($query,$connection);
        
        if(mysql_num_rows($resultSet)==1){
            return true;
        }
        else{
            return false;
        }
    }
    
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
    
    if(isset($_POST['submit'])){
        $userExists = authUser($_POST['username'],$_POST['password']);
        if($userExists){
            $userSet = getData("users","*","username",$_POST['username']);
            $user = mysql_fetch_array($userSet);
            
            $_SESSION['uID'] = $user['id'];
            $_SESSION['username'] = $user['username'];
	    $_SESSION['provider'] = NULL;
        }
	else{
	}
    }
    elseif(isset($_GET['provider'])){
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
		
		redirect_to($_SESSION['url']);

	    }
	    else{
		createSocialUser($provider_name,$userProfile->identifier,$userProfile->displayName,$userProfile->email,$userProfile->photoURL);
		$_SESSION['uID'] = $userProfile->identifier;
		$_SESSION['provider'] = $provider_name;
		redirect_to($_SESSION['url']);
	    }
    }
?>


<div class="wrapper">
    <?php
    //Prints nav bar
      //$nav = printNav(false);
      //echo $nav;
    ?>
    <div class="wrapper-content">
	<div class="container">
            <a class="btn zocial facebook" href="newLogin.php?provider=Facebook">Login with facebook</a>
             <div class = "row">
		<div class = "well col-offset-3 col-lg-6">
		    <!--form area-->
		    <form class="form-horizontal" method="post" action="newLogin.php">
			<legend>Sign In
			    <span class="pull-right">(or <a href="signup.php">create account</a>)</span>
			</legend>
			<div class="form-group">
			    <label for="username" class="col-lg-2 control-label">Username</label>
			    <div class="col-lg-10">
				<input type="text" class="form-control" id="username" name="username" placeholder="Your username" required>
			    </div>
			</div>
			<div class="form-group">
			    <label for="password" class="col-lg-2 control-label">Password</label>
			    <div class="col-lg-10">
				<input type="password" id="password" class="form-control" name="password" placeholder="******" required>
				<br>
				<button type="submit" name="submit" class="btn btn-success">Sign in</button>
				<a href="forgotPassword.php" class="btn btn-primary">Forgot Password?</a>
			    </div>
			</div>
		    </form>
		</div>
	    </div>
	</div>
    </div>
</div>


<?php include("includes/footer.php"); ?>