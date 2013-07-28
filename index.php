<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
  //generating suggestions for typeahead
  
  //list of club names
  $clubList = "var clubList = [";
  $resultSet = getData("clubs","clubName");
  
  while($row = mysql_fetch_array($resultSet)){
  $clubList .="'{$row['clubName']}',";
  }
  $clubList .="];";
?>


<?php
//Prints nav bar
  $nav = printNav(true);
  echo $nav;
?>
<?php
  //search processing
  if(isset($_GET['submit'])){
    if($_GET['searchClub']!=NULL){
      $clubSet = getData("clubs","*","clubName",$_GET['searchClub']);
    }
  }
?>
<div class="wrapper">
    <div class="container">
        <div class="row">
        <div class="jumbotron">
        <h1>Welcome to <?php echo NAME; ?>...</h1>
        <p>Here you can rate and review your favorite clubs.&nbsp;</p>
    </div>
        </div>
    <div class="row">
        
    <div id="searchBox" class="well col-lg-7">
        <form method="get" class="form-inline" action="index.php">
            <legend>Know the club name?</legend>
            <div class="col-lg-6">
                <div class="input-group">
                    <input class="form-control" type="text" id="searchClub" name="searchClub" data-provide="typeahead" data-items="4" placeholder="Enter club name to search"/>
                    <span class="input-group-btn">
                       <button type="submit" class="btn" name="submit" value="submit"><span class="glyphicon glyphicon-search"></button>
                    </span>
                </div><!-- /input-group -->
            </div>
        </form>
        Or for advanced search go to <a href="search.php">Search Clubs</a>
        <table class="table table-striped">
        <?php
        if(isset($_GET['submit'])){
            if($_GET['searchClub']!=NULL){
                if(mysql_num_rows($clubSet)>0){
                    while($club = mysql_fetch_array($clubSet)){
                        echo "<tr><td><a href=\"club.php?clubID={$club['id']}\">".$club['clubName']."</a></td><td>{$club['college']}</td><td>{$club['overallRating']}</td></tr>";
                    }
                }
            }
        } 
        
        ?>
        </table>
        <?php
            if(isset($_GET['submit'])){
                if($_GET['searchClub']!=NULL){
                    if(mysql_num_rows($clubSet)==0){
                        echo "<div class=\"alert alert-info alert-block\">No match found :(<br>
                            Hint: Use the suggestions on typing to search. :) </div>";
                    }
                }
            }
        ?>
        <?php
            if(isset($_GET['submit'])){
                if($_GET['searchClub']==NULL){
                    echo "<div class=\"alert alert-block alert-warning\">
                        Dawg you got to enter something to search!!!
                        </div>";
                }
            }
        ?>
        
    </div>
    <div class="well col-lg-4 col-offset-1" id="famousClubs">
        <h4><strong>Most Searched Clubs</strong></h4>
        <?php printTopList("hits"); ?>
    </div>
    </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>

<script>
    <?php echo $clubList; ?>
  
    $('#searchClub').typeahead({source: clubList});
</script>