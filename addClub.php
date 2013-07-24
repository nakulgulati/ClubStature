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
          </div>
          <div class="span8">
            <div class="container-fluid">
              <br>
              <br>
              <form method="post" action="clubcreated.php" enctype="multipart/form-data">
                  <label>Name of the Club</label>
                  <input name="clubName" type="text" class="input-medium" required>
                  <label>Category</label>
                  <br>
		  <?php
		  $output = "<select name =\"category\">";
		  $output.= "<option></option> ";
		  //geting the list of categories
		  $resultSet = getData("categoryname","category");
		  while($row = mysql_fetch_array($resultSet)){
		  	  $output .= "<option>{$row['category']}</option>";
		  }
		  
		  $output .= " </select>";
		  echo $output;
		  ?>
                  <label>College</label>
                  
		<?php
		$output = "<select name =\"college\">";
		$output.= "<option></option> ";
		//geting the list of colleges
		$resultSet = getData("colleges","name");
		    while($row = mysql_fetch_array($resultSet)){
		$output .= "<option>{$row['name']}</option>";
		}
		
		$output .= " </select>";
		echo $output;
		?>
                  
                  <label>Link to the Club's Page</label>
                  <input name="url" type="text" class="input-medium" required>
                  <label>Insert your club logo </label>
                  <input type="file" name="file" id="file">
                  <p>Please give a brief description of your club...</p>
                  <div class="row"></div>
                  <div class="drag-mask" data-ds-form="textarea" style="width: 904px; height: 114px;">
                    <textarea name="description" style="margin: 0px -322px 10px 0px; width: 904px; height: 114px;"
                    class="input-block-level" required></textarea>
              
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="form-actions">
        <input type="submit" class="btn btn-primary" value="Create Club" name="clubSubmitted">
        <input type="reset" class="btn" value="Reset">
      	<!--<input type="submit" class="btn btn-primary" value="Request Club" name="clubRequested">--> 
            
      </div>
    </div>
      </form>
	  
</div>
<?php include("includes/footer.php"); ?>