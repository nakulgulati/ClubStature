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
    if($_GET['college']!="(select a college)"){
        $collfilter = $_GET['college'];
    }
  }
?>

<div class="wrapper">
    <div class="container">
        
        <h1 class="page-header">Top Lists</h1>
        
        <form class="form-inline">
            <div class="col-lg-4">
        <?php
        global $connection;
        $output = "<select class=\"form-control\" name =\"college\">";
        $query = "SELECT name FROM colleges ORDER BY name";
        $output.= "<option>(select a college)</option> ";
        //geting the list of colleges
        $resultset = mysql_query($query, $connection);
        //$resultSet = getData("colleges","name");
        while($row = mysql_fetch_array($resultset)){
            $output .= "<option>{$row['name']}</option>";
        }
    
        $output .= " </select>";
        echo $output;
        ?>
        </div>
        <button type="submit" name="submitColl" class="btn btn-info">Filter</button>
        </form>
        <br>
        <div class="row">
            <div class="col-lg-6">
                <div class="col-lg-6 col-offset-3">
                    <div id="oR" class="well">
                        <h2>Overall Rating</h2>
                        <p>
                        <?php 
                          $collfilter;
                          printTopList("overallRating",$collfilter); 
                        ?>
                      </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="col-lg-6 col-offset-3">
                    <div id="r" class="well">
                        <h2>Rigor</h2>
                        <p>
                        <?php 
                          $collfilter;
                          printTopList("rigor",$collfilter); 
                        ?>
                      </p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6">
                <div class="col-lg-6 col-offset-3">            
                    <div id="c" class="well">
                        <h2>Cohesiveness</h2>
                        <p>
                            <?php 
                                $collfilter;
                                printTopList("cohesiveness",$collfilter); 
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="col-lg-6 col-offset-3">
                    <div id="sF" class="well">
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
        
        
    </div>
</div>


<?php include("includes/footer.php"); ?>