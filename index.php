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
        <div class="hero-unit hidden-phone">
        <h1>Welcome to <?php echo NAME; ?>...</h1>
        <p>Here you can rate and review your favorite clubs.&nbsp;</p>
    </div>
    <div class="row-fluid">
    <div id="searchBox" class="well span8">
        <h4>Know the club name?</h4> 
    <form method="get" class="form-inline" action="index.php">
        <div class="input-append">
            <input type="text" id="searchClub" name="searchClub" data-provide="typeahead" data-items="4" placeholder="Enter club name to search"/>
            <button type="submit" class="btn" name="submit" value="submit"><i class="icon-search"></i></button>
        </div>
    </form>
    <table class="table table-striped">
    <?php
    if(isset($_GET['submit'])){
        if($_GET['searchClub']!=NULL){
            while($club = mysql_fetch_array($clubSet)){
                echo "<tr><td><a href=\"club.php?clubID={$club['id']}\">".$club['clubName']."</a></td><td>{$club['college']}</td><td>{$club['overallRating']}</td></tr>";
            }
        }
        elseif($_GET['searchClub']==NULL){
            echo "<div class=\"alert alert-warning\">
                Dawg you got to enter something to search!!!
                </div>";
        }
    } 
    
    ?>
    </table>
    Or for advanced search go to <a href="search.php">Search Clubs</a>
    </div>
    <div class="well span4" id="famousClubs">
        <h4>Most Searched Clubs</h4>
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