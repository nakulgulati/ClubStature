<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<h1>This is the edit clubs page!</h1> 

<div class="wrapper">
    <div class="container">
	<div class = "row">
	    <div class = "well col-offset-3 col-lg-6">
		<!--form area-->
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
		    <button type="submit" name="editMyClubs" class="btn btn-success">Edit My Clubs </button>
		</form>

<?php include("includes/footer.php"); ?>