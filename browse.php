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
  <h1>
    <b>Look for groups by institute and organization type. </b> 
  </h1>
  <br>
  <br> 
  <div class="container">
  
  <?php
		if(isset($_GET['submitFilter']) and ($collegeName != "None" or $category != "None")){
			echo "you've submitted something, bitches! ";
		}
	
		else{
			echo "Ya gotta submit something, bitches!";
		}
?>
  
  
  <form method = "get" action = "browse.php">
  
  
  <h3>College or School</h3>
		  
		  <?php
		  
		  $query = "SELECT * FROM colleges" ;
		  global $connection; //getting it in the right scope
		  $resultset=mysql_query($query, $connection);
		  $output = "<select name =\"collegeName\">";
		  $output.= "<option> None </option> ";
		  $output.="<option> All </option> ";
		  while($row = mysql_fetch_array($resultset)){
			
			$output .= "<option>{$row['name']}</option>";
			
			}
			$output .= " </select>";
			echo $output;
		/*	echo "The club you chose was: ";
			echo $collegeName;  */
		  ?>
      
      <div class="pull-right span4">
        <h3>Category</h3>
			<select name="category">
			<option> None </option>
			<option> All </option>
			<option> Sports and Recreation </option>
			<option> Art, Music and Culture </option>
			<option> Academic/Professional </option>
			<option> Community Service/Volunteering </option>
			<option> Governance </option>
			<option> Greek Life </option>
			<option> Science and Technology </option>
			<option> Lifestyle </option>
			</select>
			
			<input type="submit" value="Submit" name = "submitFilter">
			</form>
      </div>
    </div>
  </div>
  
 
  <div class="control-group"></div>
</div>
</div>
</div>
<?php include("includes/footer.php"); ?>