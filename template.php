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
    </div>
    <!--Dropdown Stuff-->
                            <div class="btn-group pull-right">
                            <h3 class="user dopdown-toggle" data-toggle="dropdown">Username</h3>
                            <ul class="dropdown-menu">
                            <li><a href="passchange.php> Change Password </a> </li>
                            <li><a href="logout.php">Log Out</a></li>
                            </ul>
                            </div>
              <br><br><br>              
                            S
  </div>
</div>
            
            
<?php include("includes/footer.php"); ?>