<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
//Prints nav bar
  $nav = printNav(true);
  echo $nav;
?>
<div class="wrapper">
<div class="container">
  <div class="hero-unit">
    <h1><?php echo NAME; ?></h1>
    <br>
    <p>Ever thought about getting more involved in college, but did not know where to start? 
	   Well, we have something awesome for you! ClubStature is the best way to browse and discuss clubs before you commit.  
	   We try to help you make the best of your college experience by helping you choose the organization that is the right fit for you. 
	   Here, you can read and write reviews about various clubs on your campus and get a clearer picture of what they are about.
	</p>
    
	
    <p>
      <a class="btn btn-primary btn-large">Learn more</a> 
    </p>
  </div>
</div>

<div style="text-align: center;">
<img src="http://i1.ytimg.com/vi/AgRABgfw42Y/maxresdefault.jpg" height = 150px width= 200px alt="Our logo should be here">
</div>

<br>

<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>Designers</th>
      <th>Facebook Page</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>Amit Kalay</td>
      <td>
        <a href="https://www.facebook.com/amit.kalay.9?fref=ts">Amit's page</a>
        <br> 
      </td>
    </tr>
    <tr>
      <td>2</td>
      <td>Nakul Gulati</td>
      <td>
        <a href="https://www.facebook.com/nakul.gulati?fref=ts"> Nakul's page</a> 
      </td>
    </tr>
    <tr>
      <td>3</td>
      <td>Sudip Guha</td>
      <td>
        <a href="https://www.facebook.com/sudip.guha.524?fref=ts"> Sudip's page </a> 
      </td>
    </tr>
  </tbody>
</table>
<span class="label"> Want to contribute? Fork us on <a href="https://github.com/nakulgulati/RateMyClub"> Github </a> </span>
<span class="label pull-right"> <a href="feedback.php">Got any suggestions or feedback? </a> </span>
</div>
<?php include("includes/footer.php"); ?>
