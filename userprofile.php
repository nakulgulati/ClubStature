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
<?php
  $ccheck=false;
  $query="SELECT * FROM users WHERE username={$_SESSION['username']}";
  $result=mysql_query();
  $row=mysql_fetch_array($result);
  if($row['college']=='NULL')
  {
    $ccheck=false;
  }
  else
  {
    $ccheck=true;
  }
  
  if(isset($_GET['submit']))
  {
    $query="UPDATE users SET college='{$_GET['college']}' WHERE username='{$_SESSION['username']}'";
    mysql_query($query,$connection);
    redirect_to("userprofile.php");
  }
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
      echo "<h3><p class=\"text-info\"> {$email}</h3> </p>";
      echo "<a href=\"changemail.php\"><button>Change email ID</button></a>";
      echo "</br>";
      ?>
      
      
      <label for="college">College or School</label>
      <?php
	if($ccheck)
	{
	  $college=$row['college'];
	  echo "<p class=\"text-info\"> {$college} </p>";
	}
	else
	{
	  echo "<form action=\"userprofile.php\" method=\"GET\">";
	  echo "<input type=\"text\" name=\"college\"/>";
	  echo "<input type=\"submit\" name=\"submit\"/>";
	  echo "</form>";
	}
      ?>
	
      

      <span class="well">
	<a href="forgotPassword.php"><button type="button" class="btn btn-info">Forgot password</button></a>
	<a href="changePassword.php"><button type="button" class="btn btn-info">Change password</button></a>
	<a href="deleteAccount.php"><button type="button" class="btn btn-danger">Delete account</button></a>
      </span>
      <!--end content-->
    </div>
  </div>
</div>
            
            
<?php include("includes/footer.php"); ?>