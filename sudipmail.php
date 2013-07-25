<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
//Prints nav bar
  $nav = printNav(true);
  echo $nav;
?>



<div class="wrapper">
  <div class="container">
    <div class="hero-unit hidden-phone">
      <!--body content here-->
	  
	  <?php
		if(isset($_GET["submitEmail"])){
		echo "dawg, check your gmail inbox if you got something.";
		$to = "sudip.guha29@gmail.com";
		$from = "amitkal@umich.edu";
		$message = "Yay! The message went through!!";
		$subject = "testmail";
		$headers = "From: " . $from;
		mail($to,$subject,$message,$headers);
		echo "<br>";
		echo mail($to,$subject,$message,$headers);
		}
		?>
    </div>
    <!--Dropdown Stuff
                            <div class="btn-group pull-right">
                            <h3 class="user dopdown-toggle" data-toggle="dropdown">Username</h3>
                            <ul class="dropdown-menu">
                            <li><a href="passchange.php"> Change Password </a> </li>
                            <li><a href="logout.php">Log Out</a></li>
                            </ul>
                            </div>
              <br><br><br>  -->
	<form method = "get">
	Submit an email?
	<input type = "submit" name="submitEmail">
	</form>
  </div>
</div>
            
            
<?php include("includes/footer.php"); ?>