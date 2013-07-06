<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
//Prints nav bar
  $nav = printNav(false);
  echo $nav;
?>

<div class="wrapper">
	<div class="container">
		<div class = "row">
			<div class = "span6">
			<!--image/text area-->
			</div>
			<div class = "span6">
			<!--form area-->
				<form class="form-horizontal" method="post" action="signupProcess.php">
					<legend>
						Sign Up
						<span class="pull-right">(or <a href="login.php">Sign in</a>)</span>
					</legend>
					<div class="control-group">
						<label class="control-label" for="fname">Name</label>
						<div class="controls">
							<input type="text" id="fname" name="name" placeholder="John Doe" required>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="email">Email</label>
						<div class="controls">
							<input type="email" id="email" name="email" placeholder="johndoe@example.com" required>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="verifyEmail">Verify Email</label>
						<div class="controls">
							<input type="email" id="verifyEmail" name="verifyEmail" placeholder="johndoe@example.com" required>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="password">Password</label>
						<div class="controls">
							<input type="password" id="password" name="password" placeholder="******" required>
							<span class="help-inline">Min Length 6</span>
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<label class="checkbox"></label>
							<input type="checkbox"> I accept the Terms and Conditions.
							<button type="submit" class="btn btn-info pull-right">Create Account</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
	    
<?php include("includes/footer.php"); ?>
