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
//Login form processing

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
        <div class="well">
            <!--Post a comment-->
            <form method="post" action="club.php?clubID=<?php echo $_GET['clubID']?>">
                <textarea rows="4" id="commentArea" placeholder="Write your comment..." name="comment"></textarea><br>
                <button name="submit" type="submit" class="btn btn-info pull-right">Post Comment</button>
            </form>
        </div>
        <div class="well">
            <!--Reviews-->
            <h2>Reviews</h2>
            <hr>
            <div class="review">
                <b class="pull-right">Username</b><br>
                <p><small class="pull-right">-Timestamp</small></p><br>
                <p>
                <!--user review-->
                bdsfbjsdbfjkdsbfjkd
                </p>
                <hr>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>