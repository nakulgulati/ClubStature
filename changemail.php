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
  $meassage="Please enter your new desired email ID";
  if(isset($_POST['submit']))
  {
    $query="SELECT * FROM users WHERE username='{$_SESSION['username']}'";
    $result=mysql_query($query,$connection);
    $row=mysql_fetch_array($result);
    $oldmail=$row['email'];
    $mail=$_POST['mail'];
    $query="UPDATE users SET email='{$mail}' WHERE username='{$_SESSION['username']}'";
    if(mysql_query($query,$connection))
    {
      $message="Your email ID has been changed";
      redirect_to("userprofile.php");
    }    
  }
?>


<div class="wrapper">
  <div class="container">
    <div class="hero-unit hidden-phone">
      <!--body content here-->
      <form class="form-inline" name="mailchange" action="changemail.php" method="POST">
	<label for="newmail">New Email-ID</label>
	<input type="text" name="mail" size="20" maxlength="40" placeholder="emailID@example.com" required/>
	<button typoe="submit" class="btn-primary" name="submit">Submit</button>
      </form>
      <div class="well">
	<?php echo $meassage; ?>
      </div>
    </div>
  </div>
</div>
            
            
<?php include("includes/footer.php"); ?>