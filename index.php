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
      <h1>Welcome to Rate My Club...</h1>
      <p>Here you can rate and review your favorite clubs.&nbsp;</p>
    </div>
  </div>
</div>
    
<?php include("includes/footer.php"); ?>
