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
//Prints nav bar
  $nav = printNav(true);
  echo $nav;
?>

<div class="wrapper">
  <div class="container">
    <div class="hero-unit hidden-phone">
      <!--body conent here-->
      <form name="ratingInput" action="BasicRatingTest.php" method="GET">
        <input type="text" name="Rigor" value="0-10" size="4" maxlength="2" required/>
        <input type="text" name="Cohesiveness" value="0-10" size="4" maxlength="2" required/>
        <input type="text" name="Schedule-Friendliness" value="0-10" size="4" maxlength="2" required/>
        <br/>
        <input class="btn-primary" name="submit" type="submit">Submit</button>
        <input name="reset" type="reset">Reset</button>
      </form>
      
      <?php
      if(isset($_GET['submit']))
      {
        $ID=1;//TO REFLECT CURRENT CLUB id
        $R = $_GET['Rigor'];
        $C = $_GET['Cohesiveness'];
        $S = $_GET['Schedule-Friendliness'];
        $query="INSERT INTO
                RATING(rigor,cohesiveness,scheduleFriendliness,clubId)
                VALUES({$R},{$C},{$S},{$ID})
                ";
                //LATER WE NEED TO INSERT CLUB ID AND USER ID
        if(mysql_query($query,$connection))
        {
            $query="SELECT AVG(rigor)
                    AS ravg
                    FROM RATING
                    WHERE CLUBID={$ID}
                    ";
            $resultSet = mysql_query($query,$connection);
            
            $var=mysql_fetch_array($resultSet);
            $R=$var['ravg'];
            
            echo "Rigor avg = ".$R;
            
            $query="SELECT AVG(cohesiveness)
                    AS ravg
                    FROM RATING
                    WHERE CLUBID={$ID}
                    ";
            $resultSet = mysql_query($query,$connection);
            
            $var=mysql_fetch_array($resultSet);
            $C=$var['ravg'];
            
            echo "cohesiveness avg = ".$C;
            
            $query="SELECT AVG(scheduleFriendliness)
                    AS ravg
                    FROM RATING
                    WHERE CLUBID={$ID}
                    ";
            $resultSet = mysql_query($query,$connection);
            
            $var=mysql_fetch_array($resultSet);
            $S=$var['ravg'];
            
            echo "timeCommitment avg = ".$S;
            
            $OR=($R*4+$S*2+$C*4)/10;
            
            $query="UPDATE CLUBS
                    SET OVERALLRATING={$OR},RIGOR={$R},cohesiveness={$C},scheduleFriendliness={$S}
                    WHERE ID={$ID}";
            if(mysql_query($query,$connection))
            {
                echo "done";
            }
            else
            {
                echo "not done";
            }
          
        }
        else
        {
          "failed";
        }
      }
    ?>      
      <!--Body Content ends here-->
    </div>
  </div>
</div>
            
<?php include("includes/footer.php"); ?>
