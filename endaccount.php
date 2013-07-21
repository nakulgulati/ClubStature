<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<div class="wrapper">
	<div class="container">
		<div class = "row">
			<div class = "span7">
			</div>
			<div class = "span7">
			<!--form area-->
				<form class="form-horizontal" method="POST" action="endaccount.php">
					<legend>
						So you wanna delete your account, <?php echo $_SESSION['username']; ?> ?
					</legend>
					<div class="control-group">
						<label class="control-label">First type your password</label>
						<div class="controls">
							<input type="password" name="goodbyepassword" placeholder="Your password, please." required>
						</div>
					</div>
					
					<input type="submit" name="submitdelete">
				</form>
				
				<?php
					if(isset($_POST['submitdelete']))
					{
						$user= $_SESSION['username'];
						$searcheshwar = "SELECT hashedPass FROM users WHERE username = '{$user}'";
						$result = mysql_query($searcheshwar, $connection);
						$row = mysql_fetch_array($result);
						$hp = $row['hashedPass']; 
						$password = sha1($_POST["goodbyepassword"]);
						if($password==$hp)
						{
							
							$query="DELETE FROM users WHERE username='{$user}'";
							mysql_query($query, $connection);
							echo "Your account has now been deleted";
							session_start(); 
							$_SESSION = array();
							if(isset($_COOKIE[session_name()])) {
								setcookie(session_name(), '', time()-42000, '/');
							}
							session_destroy(); //Destroy the session
						}
						
						else
						{
							echo "We're sorry; we can't delete your account without proper credentials.";
						}
					}
				?>






<?php include("includes/footer.php"); ?>