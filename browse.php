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
<h1>Browse Clubs...</h1>
  <br>
  <br>
  <br>
  <p>
    <b></b> 
  </p>
  <h1>
    <b>Look for clubs by category and other criteria... </b> 
  </h1>
  <br>
  <br>
  <form class="form-inline">
    <p>Or Search for a club using keyword</p>
    <input type="btn" value="Search">
    <input type="btn" class="btn input-mini" name="searchText" value="Search"> 
  </form>
  <div class="container">
    <div class="row">
      <div class="span4">
        <h3>College or School</h3>
        <label class="checkbox" for="checkbox">
          <input type="checkbox" value="true" id="checkbox" name="Umich"> University of Michigan</label>
        <label class="checkbox" for="checkbox">
          <input type="checkbox" value="true" id="checkbox" name="NIIT"> NIIT Neemrana</label>
        <label class="checkbox" for="checkbox">
          <input type="checkbox" value="true" id="checkbox" name="Berkeley"> UC-Berkeley</label>
      </div>
      <div class="pull-right span4">
        <h3>Category</h3>
        <label class="checkbox" for="checkbox">
          <input type="checkbox" value="true" id="checkbox" name="sports"> Sports and Recreation</label>
        <label class="checkbox" for="checkbox">
          <input type="checkbox" value="true" id="checkbox" name="arts"> Art, Music and Culture</label>
        <label class="checkbox" for="checkbox">
          <input type="checkbox" value="true" id="checkbox" name="academia"> Academic/Professional</label>
        <label class="checkbox" for="checkbox">
          <input type="checkbox" value="true" id="checkbox" name="commservice"> Community Service/Volunteering</label>
        <label class="checkbox" for="checkbox">
          <input type="checkbox" value="true" id="checkbox" name="governance"> Governance</label>
        <label class="checkbox" for="checkbox">
          <input type="checkbox" value="true" id="checkbox" name="greek"> Greek Life</label>
        <label class="checkbox" for="checkbox">
          <input type="checkbox" value="true" id="checkbox" name="science"> Science and Technology</label>
        <label class="checkbox" for="checkbox">
          <input type="checkbox" value="true" id="checkbox" name="lifestyle"> Life Style</label>
      </div>
    </div>
  </div>
  <div class="control-group"></div>
</div>
</div>

<?php include("includes/footer.php"); ?>
