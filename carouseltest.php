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
  
      <div class="container">
        <div class="well">
          <h1 style="text-align:center"><b>Make the most of college!</b></h1>
        </div>
        <div class="well">
          <div id="carousel-example-generic" class="carousel slide">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
          </ol>
  
          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <div class="item active">
              <img src="img/SF.png"alt=""><!--put images here-->
              <div class="carousel-caption">
              </div>
            </div>
            <div class="item">
              <img src="img/R.png" alt=""><!--put images here-->
              <div class="carousel-caption">
              </div>
            </div>
            <div class="item">
              <img src="img/C.png" alt=""><!--put images here-->
              <div class="carousel-caption">
              </div>
            </div>
          </div>
  
          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
            <span class="icon-prev"></span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
            <span class="icon-next"></span>
          </a>
          </div>
        </div>
    </div>
    <div class="row">
        
    <div id="searchBox" class="well col-lg-7">
        <form method="get" class="form-inline" action="index.php">
            <legend>Know the club name?</legend>
            <div class="col-lg-6">
                <input class="form-control typeahead club" type="text" id="searchClub" name="searchClub" placeholder="Enter club name to search"/>
                <span class="help-block">Or for advanced search go to <a href="search.php">Search Clubs</a></span>
            </div>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Search <span class="glyphicon glyphicon-search"></span></button>
        </form>
        
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
                        Please enter something to search!
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
  </div>
</div>
            
            
<?php include("includes/footer.php"); ?>
