<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
//Prints nav bar
  $nav = printNav(false);
  echo $nav;
?>
<?php
if(!isset($_POST['submit'])){
    $_SESSION['url'] = $_SERVER['HTTP_REFERER'];
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
				<?php
					if($status==1){
					    $output="<div class=\"alert alert-success\">
						    Login successful.
						    </div>";
					    $url = $_SESSION['url'];
					    $output .= "<META HTTP-EQUIV=\"refresh\" CONTENT=\"3;URL={$url}\">";
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

<?php include("includes/footer.php"); ?>
