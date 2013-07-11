<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
//Prints nav bar
  $nav = printNav(true);
  echo $nav;
?>
<?php
  $clubDetails = getClubInfo($_GET['clubID']);

?>
<div class="wrapper">
    <div class="container">
       <div id="club" class="well">
        <img id="clubImg" src="img/no-image.gif">
        <div id="info">
            <ul id="clubInfo">
                <li><h2><?php echo $clubDetails['clubName']; ?></h2></li>
                <li><h4 id="college">College: </h4><?php echo $clubDetails['college']; ?></li>
                <li><h4 id="category">Category: </h4><?php echo $clubDetails['category']; ?></li>
            </ul>
            <div id="description">
                <p
                <!--description-->
                <?php echo $clubDetails['description']; ?>
                </p>
            </div>
        </div>
        <div id="rating">
           <p class="score"><?php echo $clubDetails['rating']; ?></p>
        </div>
       </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>