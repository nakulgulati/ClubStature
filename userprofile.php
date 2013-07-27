<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php

if(!loggedIn()) {
	redirect_to("{$_SERVER['REQUEST_URI']}");
}

?>

<?php
//Prints nav bar
  $nav = printNav(true);
  echo $nav;
?>

<head>
  <title>User Profile</title>
</head>
<style>
body
{
background-color:#660033;
}
</style>

<div class="wrapper">
  <div class="container">
    <div class="hero-unit hidden-phone">
      <!--body content here-->
      <h1 class="text-center">Account Admin</h1>
      <?php
      $username=$_SESSION['username'];
      $result=mysql_query("SELECT* FROM users WHERE username='{$username}'");
      $row=mysql_fetch_array($result);
      $email=$row['email'];
      echo "<h4>Username</h4>";
      echo "<h3><p class=\"text-info\">  {$username} </p> </h3>";
      echo "<br>";
      echo "<h4> Your email id</h4>";
      echo "<h3><p class=\"text-info\"> {$email}</h3> </p> </h3>";
      echo "</br>";
      ?>

      <span class="inset">
      <a href="forgotPassword.php">Forgot password</a> <br> 
      <a href="changePassword.php">Change password</a> <br>
      <a href="deleteAccount.php">Delete account</a> <br>
      </span>
      <!--end content-->
    </div>
  </div>
</div>
            
            
<?php include("includes/footer.php"); ?>