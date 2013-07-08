<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
//Prints nav bar
  //$nav = printNav(false);
  //echo $nav;
?>
<?php
//Login form processing

if(isset($_POST['submit'])){
	$username = $_POST['username'];
	$password = sha1($_POST['password']);
	
		    
	
	$query = "SELECT * 
		  FROM  `users` 
		  WHERE  `username` =  '{$username}' &&  `hashedPass` =  '{$password}'";
	
	$resultSet = mysql_query($query);
	    
	    print_r($userDetails);
	    
	if(mysql_num_rows($resultSet)==1){
	    //Only one result found
	    //User authenticated
	    
	    echo "<br><br><br><br><br><br><br><br>login success";
	    
	    $userDetails = mysql_fetch_array($resultSet);
	    
	    print_r($userDetails);
	    $_SESSION['userId'] = $userDetails['id'];
	    $_SESSION['username'] = $userDetails['username'];
	    
	    redirect_to("index.php");
	}
	else{
	    echo "<br><br><br><br><br><br><br><br>login failed";
	}
}
?>

<div class="wrapper">
	<div class="container">
		<div class = "row">
			<div class = "span6">
			<!--image/text area-->
			</div>
			<div class = "span6">
			<!--form area-->
				<form class="form-horizontal" method="post" action="login.php">
					<legend>
						Sign In
						<span class="pull-right">(or <a href="signup.php">create account</a>)</span>
					</legend>
					<div class="control-group">
						<label class="control-label" for="username">Username</label>
						<div class="controls">
							<input type="text" id="username" name="username" placeholder="Your username" required>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="password">Password</label>
						<div class="controls">
							<input type="password" id="password" name="password" placeholder="******" required>
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<button type="submit" name="submit" class="btn btn-success pull-right">Login</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php include("includes/footer.php"); ?>
