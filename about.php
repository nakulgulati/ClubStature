<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
//Prints nav bar
  $nav = printNav(true);
  echo $nav;
?>

<html>
<body>

<div class="wrapper">
<div class="container">
  <div class="hero-unit">
 <div style = "text-align: center;">   <h1><?php echo NAME; ?></h1>  </div>
    <br>
    <p>Ever thought about getting more involved in college, but didn&#39;t know where to start? 
	   Well do we have something awesome for you! ClubStature is the best way to browse and discuss clubs before you commit.  
	   We try to help you make the best of your college experience by helping you choose the organization that is the right fit for you. 
	</p>
	<p>
	Here, you can read and write reviews about various clubs on your campus and get a clearer picture of what they&#39;re about. <br> 
	Happy hunting!
	</p>
    
	
  </div>
</div>

<div style="text-align: center;">
<img src="logo.png" height = 150px width= 200px alt="Club Stature">
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
          <h4 class="modal-title">Got any suggestions or feedback?</h4>
        </div>
        <div class="modal-body">
         Simply shoot us an email to clubstature@gmail.com!
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

</p>

<!-- End of button -->

<div style = "text-align: center;">   <h1>Terms and Conditions</h1>  </div>
<br> <hr>

<h3>1.  When posting, I will post accurate, constructive reviews  <br> <br>
2.  I will refrain from using inappropriate language  <br> <br>
3.  I will respect the opinions of others on the website  <br> </h3>

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
<span class="label pull-right"> Want to contribute? Fork us on <a href="https://github.com/nakulgulati/RateMyClub"> Github </a> </span>

</div>

</body>
</html>
<?php include("includes/footer.php"); ?>