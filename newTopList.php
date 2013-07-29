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
  $collfilter = "";
  if(isset($_GET['submitColl'])){
    $collfilter = $_GET['college'];
  }
?>

<div class="wrapper">
    <div class=container">
        <ul class="nav nav-tabs col-lg-8 col-offset-2">
            <li><a href="#oR" data-toggle="tab">Overall Rating</a></li>
            <li><a href="#r" data-toggle="tab">Rigor</a></li>
            <li><a href="#c" data-toggle="tab">Cohesiveness</a></li>
            <li><a href="#sF" data-toggle="tab">Schedule Friendliness</a></li>
        </ul>
        <div id="myTabContent" class="tab-content col-lg-8 col-offset-2">
            <div id="oR" class="tab-pane fade in active">
                <h2>Overall Rating</h2>
                <p>
                <?php 
                  $collfilter;
                  printTopList("overallRating",$collfilter); 
                ?>
              </p>
            </div>
            <div id="r" class="tab-pane fade">
                <h2>Rigor</h2>
                <p>
                <?php 
                  $collfilter;
                  printTopList("rigor",$collfilter); 
                ?>
              </p>
            </div>
            <div id="c" class="tab-pane fade">
                <h2>Cohesiveness</h2>
                <p>
                <?php 
                  $collfilter;
                  printTopList("cohesiveness",$collfilter); 
                ?>
              </p>
            </div>
            <div id="sF" class="tab-pane fade">
                <h2>Schedule Friendliness</h2>
                <p>
                <?php 
                  $collfilter;
                  printTopList("scheduleFriendliness",$collfilter); 
                ?>
              </p>
            </div>
        </div>
        
    </div>
</div>


<?php include("includes/footer.php"); ?>