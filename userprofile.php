<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

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
background-color:#d0e4fe;
}
</style>

<div class="wrapper">
  <div class="container">
    <div class="hero-unit hidden-phone">
      <!--body content here-->
      <h1 class="text-center">Account Settings</h1>
      <?php
      $username=$_SESSION['username'];
      $result=mysql_query("SELECT* FROM users WHERE username='{$username}'");
      $row=mysql_fetch_array($result);
      $email=$row['email'];
      echo "<h5>Username</h5>";
      echo "<p class=\"text-info\"> {$username} </p></br>";
      echo "<h5>your email id</h5>";
      echo "<p class=\"text-info\"> {$email} </p></br>";
      ?>
      <a href="forgotPassword.php">Forgot password</a> <br>
      <a href="changePassword.php">Change password</a> <br>
      <a href="deleteAccount.php">Delete account</a> <br>
      <!--end content-->
    </div>
  </div>
</div>
            
            
<?php include("includes/footer.php"); ?>
