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
				<form class="form-horizontal" method="post" action="loginProcess.php">
					<legend>
						Sign In
						<span class="pull-right">(or <a href="signup.php">create account</a>)</span>
					</legend>
					<div class="control-group">
						<label class="control-label" for="email">Email</label>
						<div class="controls">
							<input type="email" id="email" name="email" placeholder="johndoe@example.com" required>
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
							<button type="submit" class="btn btn-success pull-right">Login</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php include("includes/footer.php"); ?>
