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
			</div>
			<div class = "span6">
			<!--form area-->
				<form class="form-horizontal" method="post" action="signup.php">
					<legend>
						Change your password
					<!--	<span class="pull-right">(or <a href="login.php">Original Password</a>)</span>  -->
					</legend>
					<div class="control-group">
						<label class="control-label" for="username">Original Password</label>
						<div class="controls">
							<input type="password" name="originpass" placeholder="Your original password" required>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="newpass">New Password</label>
						<div class="controls">
							<input type="password" id="newpass" name="newpass" placeholder="Your new password" required>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="verifynewpass">Verify New Password</label>
						<div class="controls">
							<input type="password" id="verifynewpass" name="verifynewpass" placeholder="^The thing up there" required>
						</div>
					</div> 
				</form>
				
				<input type = "submit" name="submitpasses">
					

<?php include("includes/footer.php"); ?>