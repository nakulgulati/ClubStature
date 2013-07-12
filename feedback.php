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
	// doing the emailing stuff here, dawgs.
    if(isset($_POST['submit'])){
	$to = "link1994_amit@hotmail.com";
	$from = $_POST["useremail"];
	$subject = $_POST["usersubject"];
	$message = $_POST["feedback"];
	$headers = "From:" . $from;
	
	if(mail($to,$subject,$message,$headers)){
	    echo "Mail Sent. Thank you for your suggestions.";    
	}
	else_{
	    echo "Mail not sent.";
	}
	
    }
?>

<div class="wrapper">
  <div class="container">
    <div class="row">
      <div class="span2">
        <!--image/text area--> 
      </div>
      <div class="span6">
        <!--form area-->
        <form class="form-horizontal" method="post" action="feedback.php">
          <legend>Suggestion Box</legend>
          <div class="control-group">
            <label class="control-label" for="email">Your Email Id</label>
            <div class="controls">
              <input type="email" id="useremail" name="useremail" placeholder="A_Valid_Email@example.com" required> 
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="usersubject">Subject</label>
            <div class="controls">
              <input type="text" id="usersubject" name="usersubject" placeholder="A short subject" required> 
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="feedback">Feedback</label>
            <div class="controls">
              <textarea name="feedback" id="feedback" rows="3" cols="300" style="margin-left: 0px; margin-right: 0px; width: 424px;" 
			  placeholder = "I think you should add ...(limit to 100 words)" required></textarea>
            </div>
          </div>
          <div class="control-group">
            <div class="controls">
              <button type="submit" value="Submit" name="submit" class="btn btn-success pull-right">Submit</button>
              <button type="reset" class="btn btn-success pull-right">Reset</button>
            </div>
          </div>
        </form>	
      </div>
    </div>
  </div>
</div>

<?php include("includes/footer.php"); ?>