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
    <div class="row-fluid">
        <?php printTopList("overallRating"); ?>
        
        <?php printTopList("rigor"); ?>
    </div>
    
    <div class="row-fluid">
        <?php printTopList("cohesiveness"); ?>
        <?php printTopList("scheduleFriendliness"); ?>
    </div>
  </div>
</div>

<?php include("includes/footer.php"); ?>