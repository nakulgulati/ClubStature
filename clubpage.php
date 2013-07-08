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
    <div class="row">
        <div class="span8">
            <div class="well">
                <h2>Club Name</h2>
                <h4>Description</h4>
                <div class="content">
                <!--club Description-->
                </div>
            </div>
        </div>
        
        <div class="span12">
                     <div class="well" id="well1">
        <p class="align-center">
          <b>Please Enter Your Comment In The Text Field Below (limit 500 characters)</b> 
        </p>
        <textarea class="input-block-level span10" name="Comment Inpiut" rows=5></textarea>
        <div class="form-actions">
          <div class="row">
            <div class="span8">
              <p>Please enter your position or relation to the club</p>
              <select>
				<option> President </option>
				<option> Other Officer </option>
                <option> Current Member </option>
                <option>Ex-Member </option>
                <option>Prospective Member </option>
                <option>Third Party </option>
              </select>
              <span class="label label-important">Important</span> 
            </div>
            <div class="span4">
              <button type="submit" class="btn btn-primary">Submit</button>
              <input type="reset" class="btn" value="Reset">
              <a class="btn btn-danger">Discard</a> 
            </div>
          </div>
        </div>
      </div>
                     </div>
                     
    </div>
  </div>
</div>

<?php include("includes/footer.php"); ?>