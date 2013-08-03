<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
if(!isset($_POST['submit'])){
    
    if(strpos($_SERVER['HTTP_REFERER'],"signup.php")){
	$_SESSION['url'] = "index.php";
    }
    else{
	$_SESSION['url'] = $_SERVER['HTTP_REFERER'];
    }
}
?>

<?php
//Login form processing

$status=-1;

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    
    $query = "SELECT * 
	      FROM  `users` 
	      WHERE  `username` =  '{$username}' &&  `hashedPass` =  '{$password}'";
    
    $resultSet = mysql_query($query);
	
    if(mysql_num_rows($resultSet)==1){
	//Only one result found
	//User authenticated
	
	$userDetails = mysql_fetch_array($resultSet);
	
	$_SESSION['userId'] = $userDetails['id'];
	$_SESSION['username'] = $userDetails['username'];
	
	$status = 1;
    }
    else{
	$username="";
	$password="";
	$status = 0;
    }
}
?>

<div class="wrapper">
    <?php
    //Prints nav bar
      $nav = printNav(false);
      echo $nav;
    ?>
    <div class="wrapper-content">
	<div class="container">
	    <div class = "row">
		<div class = "well col-offset-3 col-lg-6">
		    <!--form area-->
		    <form class="form-horizontal" method="post" action="login.php">
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
		    
		    <?php
		    if($status==1){
			$output="<div class=\"alert alert-success\">
				Login successful.
				</div>";
			$url = $_SESSION['url'];
			$output .= "<META HTTP-EQUIV=\"refresh\" CONTENT=\"2;URL={$url}\">";
			echo $output;
			    
		    }
		    else if($status==0){
			$output="<div class=\"alert alert-error\">
				Login failed, check details and try again.
				</div>";
			echo $output;
		    }
		    else{
			echo "";
		    }
		?>	
		</div>
	    </div>
		
	    </div>
	</div>
    </div> 
</div>




<?php include("includes/footer.php"); ?>