<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once "Mail.php"; ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>


<?php
//Prints nav bar
  //$nav = printNav(false);
  //echo $nav;
?>

<?php
//Form processing

if(isset($_POST['submit'])){
    //Form submitted
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $verifyPassword = sha1($_POST['verifyPassword']);
    
    $errors = addUser($username,$password,$verifyPassword,$email);   
	
    
    	
    if($errors['status']==1){
	$userDetails = getData("users","*","username",$username);
	$user = mysql_fetch_array($userDetails);
	
	sendMail($user['id'],"create");
    }
    
}

?>

<div class="wrapper">
	<div class="container">
		<div class = "row">
			<div class = "well col-offset-3 col-lg-6">
			<!--form area-->
			    <form class="form-horizontal" method="post" action="signup.php">
				<legend>Sign Up
				    <span class="pull-right">(or <a href="login.php">Sign in</a>)</span>
				</legend>
				<div class="form-group">
				    <label for="username" class="col-lg-2 control-label">Username</label>
				    <div class="col-lg-10">
				        <input type="text" class="form-control" id="username" name="username" placeholder="Your username" required>
				    </div>
				</div>
				<div class="form-group">
				    <label for="email" class="col-lg-2 control-label">Email</label>
				    <div class="col-lg-10">
				        <input type="email" class="form-control" id="email" name="email" placeholder="Email Id..." required>
				    </div>
				</div>
				<div class="form-group">
				    <label for="password" class="col-lg-2 control-label">Password</label>
				    <div class="col-lg-10">
					<input type="password" id="password" class="form-control" name="password" placeholder="******" required>
				    </div>
				</div>
				<div class="form-group">
				    <label for="password" class="col-lg-2 control-label">Verify Password</label>
				    <div class="col-lg-10">
					<input type="password" id="verifyPassword" class="form-control" name="verifyPassword" placeholder="******" required>
					

					<div class="checkbox">
					    <label>
						<input type="checkbox" required> I accept the  <a data-toggle="modal" href="#tc">Terms and Conditions.  </a>
					    </label>
					</div>
					    <button type="submit" name="submit" class="btn btn-success">Sign up</button>
				    </div>
				</div>
			    </form>
			    
<div class="modal fade" id="tc">
    <div class="modal-dialog">
	<div class="modal-content">
	    <div class="modal-body">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<div style = "text-align: center;">
		    <h3>Terms and Conditions</h3>
		</div>
		<br> <hr>
		<h5>1.  When posting, I will post accurate, constructive reviews  <br> <br>
		2.  I will refrain from using offensive language  <br> <br>
		3.  I will respect others' opinions on the website  <br> </h5>
	    </div>
	</div>
    </div>
</div>
			    
				<?php
				global $errors;
				
				if(isset($errors['status'])){
				    if($errors['status']==1){
					$output="<div class=\"alert alert-success\">
						{$errors[0]}
						</div>";
					//$output .= "<META HTTP-EQUIV=\"refresh\" CONTENT=\"2;URL=login.php\">";
					echo $output;
				    }
				    elseif(($errors['status']==0) && (count($errors)>1)){
					$output="<div class=\"alert alert-error\">";
					foreach($errors as $key => $value){
					    if($value != '0'){
						$output .= $value."<br>";
					    }	
					}
					$output	.= "</div>";
					echo $output;
				    }
				}
				?>
			</div>
		</div>
	</div>
</div>
	    
<?php include("includes/footer.php"); ?>
