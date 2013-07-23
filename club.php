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
        <img id="clubImg" src="img/no-image.gif">
        <div id="info">
            <ul id="clubInfo">
                <li><h2><?php echo $clubDetails['clubName']; ?></h2></li>
                <li><h4 id="college">College: </h4><?php echo $clubDetails['college']; ?></li>
                <li><h4 id="category">Category: </h4><?php echo $clubDetails['category']; ?></li>
            </ul>
              <div id="other">
                <!--rigor-->
           <p class="scoreOther"><?php echo $clubDetails['rigor']; ?></p>
        </div>
              <div id="other">
                <!--cohesiveness-->
           <p class="scoreOther"><?php echo $clubDetails['cohesiveness']; ?></p>
        </div>
              <div id="other">
                <!--schedule friendliness-->
           <p class="scoreOther"><?php echo $clubDetails['scheduleFriendliness']; ?></p>
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
            <button class="btn" type="submit" name="ratingSubmit">Rate this club</button>
        <?php
            if((loggedIn())){
                $rating;
                $rating =   "<select name=\"rigor\" class=\"pull-right\">
                            <option>0</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            </select>
                            <select name=\"cohesiveness\" class=\"pull-right\">
                            <option>0</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            </select>
                            <select name=\"scheduleFriendliness\" class=\"pull-right\" class=\"pull-right\">
                            <option>0</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            </select>";
                echo $rating;
            }
        ?>
        </form>
        </div>
        </div>
        <div class="well">
            <!--Post a comment-->
            <form method="post" action="club.php?clubID=<?php echo $_GET['clubID']?>">
                <textarea rows="4" id="commentArea" placeholder="Write your comment..." name="comment"></textarea><br>
                <button name="submit" type="submit" class="btn btn-info pull-right">Post Comment</button>
            </form>
        </div>
        <div id="comment">
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