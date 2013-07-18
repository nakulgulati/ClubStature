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
        <div class="well">
          <h1>Create a club page</h1>
        </div>
        <div class="row">
          <div class="span5">
            <p>This page will help you to set up your club page.</p>
            <p>Please fill all the fields. Those marked with a * are necessary.</p>
          </div>
          <div class="span8">
            <div class="container-fluid">
              <p>
                <br> 
              </p>
              <form method="get">
                  <label>Name of the Club</label>
                  <input name="clubName" type="text" class="input-medium" required>
                  <label>Category</label>
                  <br>
                  <select name="category">
			<option> Sports and Recreation </option>
			<option> Art, Music and Culture </option>
			<option> Academic/Professional </option>
			<option> Community Service/Volunteering </option>
			<option> Governance </option>
			<option> Greek Life </option>
			<option> Science and Technology </option>
			<option> Lifestyle </option>
			</select>
                  <label>College</label>
                  
                  <?php //getting the list of college names into the dropdown here
		  
		  $query = "SELECT * FROM colleges ORDER BY name ASC" ;
		  global $connection; //getting it in the right scope
		  $resultset=mysql_query($query, $connection);
		  $output = "<select name =\"college\">";
		  //$output.= "<option> None </option> ";
		  //$output.="<option> All </option> ";
		  while($row = mysql_fetch_array($resultset)){
			
			$output .= "<option>{$row['name']}</option>";
			
			}
			$output .= " </select>";
			echo $output;
		  ?>
                  
                  <label>Link to the Club's Page</label>
                  <input name="url" type="text" class="input-medium" required>
                  <label>Insert your club logo </label>
                  <input type="hidden" name="MAX_FILE_SIZE" value="500" />
                  <input type="file" name = "picture">
                  <p>Please give a brief description of your club...</p>
                  <div class="row"></div>
                  <div class="drag-mask" data-ds-form="textarea" style="width: 904px; height: 114px;">
                    <textarea name="description" name="suggestion" style="margin: 0px -322px 10px 0px; width: 904px; height: 114px;"
                    class="input-block-level" required></textarea>
              
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="form-actions">
        <input type="submit" class="btn btn-primary" value="Submit">
        <input type="reset" class="btn" value="Reset">
            
      </div>
    </div>
      </form>
</div>
<?php include("includes/footer.php"); ?>