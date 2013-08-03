<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
<?php
//Prints nav bar
  $nav = printNav(true);
  echo $nav;
?>

<br><br><br><br><br>
<div class="wrapper">
    <div class="container">
		<div class = "row">
	    	<div class = "well col-offset-3 col-lg-6">
		<!--form area--> 

		<form method = "get">
		<div class="form-group">
		    <div class="col-lg-6">	
			<?php
			    $output = "<select class=\"form-control\" name =\"clubToEdit\">";
			    $query = "SELECT clubName FROM clubs WHERE creator = '{$_SESSION['username']}' ORDER BY clubName";
			    $output.= "";
			    //geting the list of colleges
			    $resultset = mysql_query($query, $connection);
			    //$resultSet = getData("colleges","name");
			    while($row = mysql_fetch_array($resultset)){
				$output .= "<option>{$row['clubName']}</option>";
			    }
			
			    $output .= " </select>";
			    echo $output;
			?>

		    </div>
		</div>
		    <button type="submit" name="editMyClubs" class="btn btn-success">Edit This Club </button>
		    </div>
		</form>
		</div>
	</div>

<center>
	<?php 
	if (isset($_GET['editMyClubs'])){
		echo "The form will appear here";
	}
	?>
		
</center>
</div>

<?php include("includes/footer.php"); ?>

		<!--	<div class="form-group">
			<label for="username" class="col-lg-2 control-label">Username</label>
			<div class="col-lg-10">
			    <input type="text" class="form-control" id="username" name="username" placeholder="Your username" required>
			</div>