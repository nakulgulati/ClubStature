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
            <legend><h3><b>What is Club Stature</b></h3></legend>
           
            <p>
                Do you want to just sail through student life or live the experience? Here at clubstature, we help you choose the activities that suit your taste and inclination. We will help you lift your stature.<br>
                <br>
                We would like to ask you a simple question: How can you assess your fit for an activity without a plethora of opinions? Where can you find these opinions without bugging the right people?<br> 
                <br>
                This is where we come in.  We've provided a forum for you to browse, rate, and review your favorite high school or college organizations. If you aren't sure what you want to join, you can filter clubs by category, institute, number of hits and top-rated groups.<br>  
                <br>
                We hope you use this website to help yourselves and your friends <strong> get involved. </strong> <br> <br> Happy hunting!
            </p>
            
            <br>
            <form class="form-horizontal" method="post" action="login.php">
            <legend>Got questions or feedback?</legend>
            <div class="form-group">
                <label for="email" class="col-lg-2 control-label">Email</label>
                <div class="col-lg-6">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Your email" required>
                </div>
            </div>
            <div class="form-group">
                <label for="feedback" class="col-lg-2 control-label">Feedback</label>
                <div class="col-lg-6">
                    <textarea name="feedback" class="form-control" placeholder="Your valuable feedback..." rows="4"></textarea>
                    <br>
                    <button type="submit" name="submit" class="btn btn-success" >Submit</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
