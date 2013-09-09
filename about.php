<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
    if(isset($_POST['submit'])){
        //send email to self with the feedback.
    }
?>

<div class="wrapper">
    <?php
        //Prints nav bar
        $nav = printNav(true);
        echo $nav;
    ?>
    <div class="wrapper-content">
        <div class="container">
            <!--content-->
           <center> <img src = "aboutpage.jpg" alt ="Our website description"> </center>        
        </div>
    </div>
</div>
<br>
<br>
<center> Got any feedback or simply want to chat with us?  Post your comments on our <a href = "https://www.facebook.com/clubstature"> Facebook Page! </a> </center>
<hr>
<?php include("includes/footer.php"); ?>
