<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
//Prints nav bar.
  $nav = printNav(true);
  echo $nav;
?>

<html>
<body>

<div class="wrapper">
<div class="container">
  <div class="hero-unit">
 <div style = "text-align: center;">   <img src="logo.png" width= 400px alt="Club Stature"> </div>
    <br> <h3>
    <p> Looking for ways to make the most of your college or high school's extracurricular opportunities?
    Well, look no further! Here at clubstature, we try to help you choose the organizations that are the right fit for you. 
	</p>
	<p>
	Here, you can read and write reviews about what other people are saying about the various clubs on your campus. 
	We want to make sure you&#39;re well-informed before committing.
	Happy hunting!
	</p>  </h3>
    
	
  </div>
</div>

<div style="text-align: center;">

</div>
<br>

<!-- Button to trigger modal -->
<p class = "text-center">
  <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-large">Contact Info</a>

  <!-- Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Got any suggestions or feedback?  Would you like to see a new feature?</h4>
        </div>
        <div class="modal-body">
         Simply shoot us an email to clubstature@gmail.com!
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

</p>

<!-- End of button -->    

<div style = "text-align: center;">   <h1> Privacy Policy </h1>  </div>
<br> <hr>

<h3> The only data we collect from you is your username and email address.  <br> <br>
	You may choose to submit your real name and institution you attend.  <br> <br>
	Although this is by no means required, it will improve the authenticity of your review.  <br> </h3>

<br><br><br> <hr>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Contributors</th>
      <th>Facebook Page</th>
	  <th> Email </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>Amit Kalay</td>
      <td>
        <a href="https://www.facebook.com/amit.kalay.9?fref=ts">Amit's page</a>
      </td>
	  <td> amitkal@umich.edu </td>
    </tr>
    
	<tr>
      <td>2</td>
      <td>Nakul Gulati</td>
      <td> <a href="https://www.facebook.com/nakul.gulati?fref=ts"> Nakul's page</a> </td>
	  <td> nakul.behindthestrokes@gmail.com </td>
	  
    </tr>
	
    <tr>
      <td>3</td>
      <td>Sudip Guha</td>
      <td> <a href="https://www.facebook.com/sudip.guha.524?fref=ts"> Sudip's page </a> </td>
	  <td> sudip.guha29@gmail.com </td>
    </tr>
  </tbody>
</table>
<span class="label pull-right"><h4> Want to contribute? Fork us on <a href="https://github.com/nakulgulati/RateMyClub"> Github </a> </h4> </span>

</div>

</body>
</html>
<?php include("includes/footer.php"); ?>
