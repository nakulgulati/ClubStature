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
  $nav = printNav(false);
  echo $nav;
?>
<?php
global $connection;
  $ccheck=false;
  $query="SELECT * FROM users WHERE username='{$_SESSION['username']}'";
  echo $query;
  $result=mysql_query($query,$connection);
  $row=mysql_fetch_array($result);
  if($row['college']==NULL)
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
    <div class="well">
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
      //echo "<a href=\"changemail.php\"><button>Change email ID</button></a>";
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
	  $output="<form action=\"userprofile.php\" method=\"GET\">";
	  $output.= "<select name =\"college\">";
	  $output.= "<option></option> ";
	  //geting the list of colleges
	  $resultSet = getData("colleges","name");
	  while($row = mysql_fetch_array($resultSet))
	  {
	    $output .= "<option>{$row['name']}</option>";
	  }
	  
	  $output .= " </select>";
	  $output.="<input type=\"submit\" name=\"submit\"/>";
	  $output.="</form>";
	  echo  $output;
	}
      ?>
	
      

      <span class="inset">
	<a data-toggle="modal" href="#ce" data-target="#ce">Change Email-ID</a>
	<a data-toggle="modal" href="#cp" data-target="#cp">Change password</a>
	<a href="deleteAccount.php">Delete account</a>
      </span>
      <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-large">Launch demo modal</a>

      <!-- Change email ID -->
      <div class="modal" id="ce">
	<div class="modal-dialog">
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	      <h4 class="modal-title">Modal title</h4>
	    </div>
	    <div class="modal-body">
	      <form class="form-inline" name="mailchange" method="POST">
		<label for="newmail">New Email-ID</label>
		<input type="text" name="mail" size="20" maxlength="40" placeholder="emailID@example.com" required/>
		<button typoe="submit" class="btn-primary" name="submitE">Submit</button>
	      </form>
	    </div>
	  </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      <!--end content-->
      
      
      
      <!-- Change Password -->
      <div class="modal" id="cp">
	<div class="modal-dialog">
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	      <h4 class="modal-title">Modal title</h4>
	    </div>
	    <div class="modal-body">
	      <!--form area-->
		<form class="form-horizontal" method="POST">
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
		    <input type="submit" name="submitP">
		</form>
	    </div>
	  </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      <!--end content-->
    </div>
  </div>
</div>         
<?php
  if(isset($_POST['submitE']))
  {
    changemail($_POST['mail']);
    redirect_to("userprofile.php");
  }
  if(isset($_POST['submitP']))
  {
    changePassword($_SESSION['username'],$_POST['originpass'],$_POST['newpass'],$_POST['verifynewpass']);
  }
?>
<?php include("includes/footer.php"); ?>