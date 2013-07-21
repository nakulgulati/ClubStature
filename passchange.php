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
if (!loggedIn()){
redirect_to("login.php");}
 ?>

<div class="wrapper">
	<div class="container">
		<div class = "row">
			<div class = "span7">
			</div>
			<div class = "span7">
			<!--form area-->
				<form class="form-horizontal" method="POST" action="passchange.php">
					<legend>
						So you wanna change your password, <?php echo $_SESSION['username']; ?> ?
					</legend>
					<div class="control-group">
						<label class="control-label" >Original Password</label>
						<div class="controls">
							<input type="password" name="originpass" placeholder="Your original password" required>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="newpass">New Password</label>
						<div class="controls">
							<input type="password" id="newpass" name="newpass" placeholder="Your new password (atleast 6 characters)" required>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="verifynewpass">Verify New Password</label>
						<div class="controls">
							<input type="password" id="verifynewpass" name="verifynewpass" placeholder="^The thing up there" required>
						</div>
					</div> 
					<input type="submit" name="submitpasses">
				</form>

<?php 

if(isset($_POST['submitpasses'])){
	global $connection;
	$user = $_SESSION['username'];
	$originalpassword = $_POST["originpass"];
	$searcheshwar = "SELECT hashedPass FROM users WHERE username = '{$user}'";
	$result = mysql_query($searcheshwar, $connection);
	$row = mysql_fetch_array($result);
	$hashedOriginalPassword = $row['hashedPass']; 
	$newpassword = $_POST["newpass"];
	$verifynewpassword = $_POST["verifynewpass"];
	if (($newpassword != $verifynewpassword) or (strlen($newpassword) < 6)){
		echo "You gotta be <i> sure </i> about your new password, dawg, and your new password <i> has </i> to be greater than 6 characters.";
	}
	
	else { 
		if($hashedOriginalPassword == sha1($originalpassword)){
			echo "you are one step closer to changing your password!";
			echo "<br>";
			$enteredpassword = sha1($newpassword);
			$updatequery = "UPDATE users SET hashedPass = '{$enteredpassword}' WHERE username = '{$user}'";
			mysql_query($updatequery, $connection);
			echo "<br>";
			echo "You have successfully changed your password!";
		} 
	}
	
}
	
	
?>
<!--				
/*<?php  This was the way to get the username from the session 
	if(loggedIn()){
		echo $_SESSION['username'];
		}
?> */ 
-->

<?php include("includes/footer.php"); ?>