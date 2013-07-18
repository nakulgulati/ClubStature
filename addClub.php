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
//Prints nav bar
  $nav = printNav(true);
  echo $nav;
?>

<title>addClub.php</title>
<div class="wrapper">
  <div class="container">
    <div class="well">
      <h1>Create a club page</h1>
    </div>
    <div class="row">
      <div class="span5">
        <p>This page will help you to set up your club page.</p>
        <p>Please fill all the fields. Those marked by * are necessary.</p>
      </div>
      <div class="span8">
        <div class="container-fluid">
          <p>
            <br> 
          </p>
          <label>Name of the Club</label>
          <input type="text" class="input-medium">
          <label>Category</label>
          <br>
          <input type="text" class="input-medium">
          <label>College</label>
          <input type="text" class="input-medium">
          <label>Link to the Club Page</label>
          <input type="text" class="input-medium">
          <label>Insert your club icon/picture </label>
          <input type="hidden" name="MAX_FILE_SIZE" value="500" />
          <input type="file" name = "picture">
          <p>Please give a brief description of your club...</p>
          <div class="row"></div>
          <textarea style="margin: 0px -322px 10px 0px; width: 904px; height: 114px;"
          class="input-block-level"></textarea>
        </div>
      </div>
    </div>
  </div>
  <div class="form-actions">
    <button type="submit" class="btn btn-primary">Submit</button>
    <input type="reset" class="btn" value="Reset"> 
  </div>
</div>

<?php include("includes/footer.php"); ?>