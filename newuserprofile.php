<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
//Prints nav bar
 //$nav = printNav(true);
 //echo $nav;
?>
<?php
  $info="";
?>
<head>
  <link href="css/usersyle.css">
</head>

<div class="wrapper">
  <div class="container-fluid">
    <div class="col-lg-4">
      <a>forgot password</a><br/>
      <a>change password</a><br/>
      <a>change email-ID</a><br/>
      <a>User Info</a><br/>
    </div>
    <div class="col-lg-8">
      <?php echo $info; ?>
    </div>
  </div>
</div>
            
            
<?php include("includes/footer.php"); ?>