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
  if(isset($_GET['clubID'])){
    $clubDetails = getClubInfo($_GET['clubID']);
    hit($_GET['clubID']);
  }
?>

<?php
//rate
if(isset($_POST['ratingSubmit'])){
    if(loggedIn()){
        //rate processing
        $st = calculateRating($_GET['clubID'],$clubDetails['clubName'],$_SESSION['userId'],$_SESSION['username'],$_POST['rigor'],$_POST['cohesiveness'],$_POST['scheduleFriendliness']);
        echo $st;
        redirect_to("{$_SERVER['REQUEST_URI']}");
    }
    else{
        redirect_to("login.php");
    }
}
?>
<?php
//comment processing
$storeComment = false;
if(isset($_POST['submit'])){
    if(loggedIn()){
    
    $comment = $_POST['comment'];
    $today = getdate();
    $timestamp = $today['hours'].":".$today['minutes']." ".$today['mday']."/".$today['mon']."/".$today['year'];
    
    $userDetails = getUserInfo($_SESSION['userId']);
    $username = $userDetails['username'];
    
    $commentQuery = "INSERT INTO `comments`(`timeStamp`, `clubID`, `username`, `comment`) VALUES ('{$timestamp}','{$_GET['clubID']}','{$username}','{$comment}')";
    $result = mysql_query($commentQuery,$connection);
    }
    else{
        if(!loggedIn()){
            redirect_to("login.php");
        }
    }
}

?>
<div class="wrapper">
    <div class="container">
       <div id="club" class="well">
        <!--club-->
        <?php
            $img;
            if($clubDetails['image']==""){
                $img =  "no-image.gif";
            }
            else{
                $img = $clubDetails['image'];
            }
        ?>
        <div class="imgHolder"><img id="clubImg" src="img/clubImages/<?php echo $img; ?>"></div>
        <div id="info">
            <ul id="clubInfo">
                <li><h2><?php echo $clubDetails['clubName']; ?></h2></li>
                <li><h4 id="college">College: </h4><?php echo $clubDetails['college']; ?></li>
                <li><h4 id="category">Category: </h4><?php echo $clubDetails['category']; ?></li>
            </ul>

            <div id="otherSF">
                <!--schedule friendliness-->
                <abbr title="Schedule Friendliness" class="initialism"><p class="scoreOther"><?php echo $clubDetails['scheduleFriendliness']; ?></p></abbr>
            </div>
            
            <div id="otherC">
                <!--cohesiveness-->
                <abbr title="Cohesiveness" class="initialism"><p class="scoreOther"><?php echo $clubDetails['cohesiveness']; ?></p></abbr>
            </div>
            
            <div id="otherR">
            <!--rigor-->
                <abbr title="Rigor" class="initialism"><p class="scoreOther"><?php echo $clubDetails['rigor']; ?></p></abbr>
                </div>
            <div id="description">
                <p
                <!--description-->
                <?php echo $clubDetails['description']; ?>
                </p>
              
            </div>
        </div>
        <div id="rating">
           <p class="score"><?php echo $clubDetails['overallRating']; ?></p>
        </div>

        <div id="ratingForm">
        <form class="form-inline" method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
            <button class="btn btn-default" type="submit" name="ratingSubmit">Rate this club</button>
        <?php
            if((loggedIn())){
                $rating;
                $rating =   "<div id=\"selects\">
                            <label><a class=\"help\" data-original-title=\"How challenging is this activity?\">Rigor</a></label>
                            <select class=\"form-control\" id=\"rigor\" name=\"rigor\">
                            <option>0</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            </select>
                            <label><a class=\"help\" data-original-title=\"Do you feel like you're working together?\">Cohesiveness</a></label>
                            <select class=\"form-control\" id=\"cohesiveness\" name=\"cohesiveness\">
                            <option>0</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            </select>
                            <label><a class=\"help\" data-original-title=\"How heavy is yor time commitment? Is the group flexible?\">Schedule Friendliness</a></label>
                            <select class=\"form-control\" id=\"scheduleFriendliness\" name=\"scheduleFriendliness\">
                            <option>0</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            </select>
                            </div>";
                echo $rating;
            }else{
                echo "<span class=\"help-block\">You must me logged in to rate!!!</span>";
            }
        ?>
        </form>
        </div>

        </div>
        <div class="well" id="comment">
            <!--Post a comment-->
            <form method="post" action="club.php?clubID=<?php echo $_GET['clubID']?>">
                <textarea rows="4" id="commentArea" placeholder="Write your comment..." name="comment"></textarea><br>
                <button name="submit" type="submit" class="btn btn-info pull-right"><i class="icon-comment icon-white"></i> Post Comment</button>
            </form>
        </div>
        <div id="reviews">
            <!--Reviews-->
            <h2>Reviews</h2>
            <!--<hr>-->
            <table class="table table-striped">
            <?php 
            //comment
            getComments($_GET['clubID']);
            ?>
            </table>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>
<script>
    $('.help').tooltip();
</script>