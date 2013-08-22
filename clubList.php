<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>


<?php
    
    function setReturnPath($sessionID,$returnURL){
	global $connection;
	
	$query = "INSERT INTO `returnPath`(`sessionID`, `returnURL`) VALUES ('{$sessionID}', '{$returnURL}')";
        confirmQuery(mysql_query($query,$connection));
    }
    
    function deleteReturnPath($sessionID){
        $query="DELETE FROM `returnPath` WHERE `sessionID`='{$sessionID}'";
        confirmQuery(mysql_query($query,$connection));
    }

    //setReturnPath(session_id(),$_SERVER['HTTP_REFERER']);
?>

<div class="wrapper">
    <div class="wrapper-content">
        <div class="container">
            <!--list of clubs-->
            <?php
                getClubList();
            ?>
        </div>  
    </div>
</div>
    
<?php include("includes/footer.php"); ?>
