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
						Sign Up
						<span class="pull-right">(or <a href="login.php">Sign in</a>)</span>
					</legend>
					<div class="control-group">
						<label class="control-label" for="username">Username</label>
						<div class="controls">
							<input type="text" id="username" name="username" placeholder="Select a username" required>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="email">Email</label>
						<div class="controls">
							<input type="email" id="email" name="email" placeholder="johndoe@example.com" required>
						</div>
					</div>

<?php include("includes/footer.php"); ?>