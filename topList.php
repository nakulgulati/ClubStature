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

<div style = "text-align: center;"><h1><u> Top Lists </u></h1> </div>

<?php
  $collfilter = "";
  if(isset($_GET['submitColl'])){
    $collfilter = $_GET['college'];
  }
?>
      <div class="row">
        <div class="col-lg-6">
          <img class="img-circle" data-src="holder.js/140x140">
          <h2>Overall Rating</h2>
          <p> <?php 
              $collfilter;
              printTopList("overallRating",$collfilter); 
              ?>
          </p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-6">
          <img class="img-circle" data-src="holder.js/140x140">


          <h2>Rigor</h2>
          <p><?php 
              global $collfilter;
              printTopList("rigor", $collfilter); 
              ?>
          </p>
        </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
        <div class="row">
        <div class="col-lg-6">
          <img class="img-circle" data-src="holder.js/140x140">


          <h2>Supportiveness</h2>
          <p> <?php global $collfilter; printTopList("cohesiveness", $collfilter); ?> </p>
        </div><!-- /.col-lg-4 -->
        
      
  
      <hr class="featurette-divider">
<div class="col-lg-6">
      <h2>Time Commitment</h2>
          <p> <?php global $collfilter; printTopList("scheduleFriendliness", $collfilter); ?> </p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->
      </div>

    </div><!-- /.container -->
    <br> <br>

    <div style = "text-align: center;"> 
    
    <form method = "get">
    <label>College</label>           
    <?php
        global $connection;
        $output = "<select name =\"college\">";
        $query = "SELECT name FROM colleges ORDER BY name";
        //$output.= "<option></option> ";
        //geting the list of colleges
        $resultset = mysql_query($query, $connection);
        //$resultSet = getData("colleges","name");
        while($row = mysql_fetch_array($resultset)){
    $output .= "<option>{$row['name']}</option>";
    }
    
    $output .= " </select>";
    echo $output;
    ?>

    
    <input type = "submit" name = "submitColl">
    </form>
    </div>




  <!--  <div class="row-fluid">
        <?php printTopList("overallRating"); ?> //the overall rating top list...
        
        <?php printTopList("rigor"); ?>
    </div>  -->
  
  </div>
</div>

<?php include("includes/footer.php"); ?>