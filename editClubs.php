<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
  $nav = printNav(true);
  echo $nav;
  if(!loggedIn()) {
  	redirect_to("login.php");
  }
?>

<br><br><br><br><br>
<div class="wrapper">
    <div class="container">
		<div class = "row">
	    	<div class = "well col-offset-3 col-lg-6">
		<!--form area--> 

				<form method = "get" name = "getDropdowns">
					<div class="form-group">
		    			<div class="col-lg-6">	
						<?php
			    
			    		$query = "SELECT clubName FROM clubs WHERE creator = '{$_SESSION['username']}' ORDER BY clubName";
			    		$resultset = mysql_query($query, $connection);
			    		//echo "You can edit " . mysql_num_rows($resultset) . " organizations";
			    		if(mysql_num_rows($resultset)==0){
							//put a 3-second timer here
							$output="<div class=\"alert alert-error\">
							You don't have permissions to edit or transfer any organizations!.
							</div>";
							$url = "index.php";	//change this as per requirement
							$output .= "<META HTTP-EQUIV=\"refresh\" CONTENT=\"3;URL={$url}\">";
							echo $output;
			    			//redirect_to("index.php");
			    		}
			    		else{
			    			$output = "<select class=\"form-control\" name =\"clubToEdit\">";
			    				while($row = mysql_fetch_array($resultset)){
									$output .= "<option>{$row['clubName']}</option>";
					    		}
			
			    	$output .= " </select>";
			    	echo $output; echo "<br>";
			    	echo "<button type=\"submit\" name=\"editMyClubs\" class=\"btn btn-success\">Edit This Club </button>";
			    	echo "<br><h3> OR </h3> <br>"; 
			    	echo "<button type=\"submit\" name=\"transfer\" class=\"btn btn-success\"> Transfer Ownership </button>";
							}
						?>

		    		</div>
			</div>
		    
		</div>
	</form>  <!-- The pull dropdowns thing end here -->

  </div>
</div>

<!-- The transfer ownership thing starts here  -->
<center>
<form method = "get" name = "transferOther">
	<?php
		if (isset($_GET['transfer'])){
			echo "Write the username of the person you want to transfer the club to: <br>";
			echo "<input type = \"text\" name = \"transferTo\" required>";
			echo "<input type = \"submit\" value = \"submit\" name = \"transferTo\" ";
		}
	?>
</form>

<?php
	if (isset($_GET['transferTo'])) {
		echo "This is what would happen if you actually typed something! <br>";
	}
?>

</center>


<!-- The club editing thing starts here -->
<center>
<form method = "post" name = "makeChanges">
	<?php
		global $connection;
		if (isset($_GET['editMyClubs'])) {
			$defaultQuery = "SELECT * FROM clubs WHERE creator = '{$_SESSION['username']}' AND clubName = '{$_GET['clubToEdit']}' LIMIT 1";
			$defResults = mysql_query($defaultQuery, $connection);
			$rowDefault = mysql_fetch_array($defResults);
			//echo $rowDefault['id'];

			//New Club Name			
			echo "<div class=\"form-group\">
		    <label for=\"newClubName\" class=\"col-lg-2 control-label\"> New Name of Your Club </label>
		    <div class=\"col-lg-6\">
			<input type=\"text\" value = '{$rowDefault['clubName']}' class=\"form-control\" id=\"newClubName\" name=\"newClubName\" required>
		    </div> <br>
			</div> <br>";

			//New Club Category
				
				echo "<div class=\"form-group\">
		    		<label for=\"newCategory\" class=\"col-lg-2 control-label\"> Updated Category </label>
		    		<div class=\"col-lg-6\">";
					$categoryOutput = "<select class=\"form-control\" name =\"newCategory\" required>";
			    	$categoryOutput .= "<option> {$rowDefault['category']} </option>";
			    	$resultSet = getData("categoryname","category");
			    	while ($categoryRow = mysql_fetch_array($resultSet)){
						$categoryOutput .= "<option>{$categoryRow['category']}</option>";
			    	}
			
			    $categoryOutput .= " </select>";
			    echo $categoryOutput;

			    echo "</div> <br> </div> <br>";
			

			/*New Club College
			
			//getting the list of category names
			//$resultSet = getData("colleges","name");
			echo "<div class=\"form-group\">
		    <label for=\"newCollege\" class=\"col-lg-2 control-label\"> New College </label>
		    <div class=\"col-lg-6\">";

		    	$collegeOutput = "<select class=\"form-control\" name =\"newCollege\" required>";
			    $collegeOutput .= "<option> {$rowDefault['college']} </option>";
			    $collegeResultSet = getData("colleges", "name");
			    while ($collegeRow = mysql_fetch_array($collegeResultSet)){
				$collegeOutput .= "<option>{$collegeRow['name']}</option>";
			    }
			
			    $collegeOutput .= " </select>";
			    echo $collegeOutput;

		    echo "</div> <br> </div> <br>"; */

			

			//New Club Url
			echo "<div class=\"form-group\">
		    <label for=\"newUrl\" class=\"col-lg-2 control-label\"> New Url </label>
		    <div class=\"col-lg-6\">
			<input type=\"text\" value = '{$rowDefault['url']}' class=\"form-control\" id=\"newUrl\" name=\"newUrl\" required>
		    </div> <br>
			</div> <br>";

			//New Club Description
			echo "<div class=\"form-group\">
		    <label for=\"newDesc\" class=\"col-lg-2 control-label\"> New Club Description </label>
		    <div class=\"col-lg-6\">
			<textarea class=\"form-control\" name=\"newDesc\" class=\"input-block-level\" required>{$rowDefault['description']}</textarea><br>
		    </div> <br>
			</div> <br>";

			echo "<br>";
			echo "<button type=\"submit\" name=\"makeClubChanges\" class=\"btn btn-success\"> Submit Changes </button>";
			}
	?>
	</form>
	<?php
		if (isset($_POST['makeClubChanges']))
		{
		  $newClubName=$_POST['newClubName'];
		  $newCategory=$_POST['newCategory'];
		  $newUrl=$_POST['newUrl'];
		  $newDescription=$_POST['newDesc'];
		  //global $rowDefault;
		  global $connection;
      
		  $defaultQuery = "SELECT * FROM clubs WHERE creator = '{$_SESSION['username']}' AND clubName = '{$_GET['clubToEdit']}' LIMIT 1";
		  $defResults = mysql_query($defaultQuery, $connection);
		  $rowDefault = mysql_fetch_array($defResults);
		  $updateQuery = "UPDATE clubs SET clubName = '{$newClubName}', description = '{$newDescription}', url = '{$newUrl}', category='{$newCategory}' WHERE id = {$rowDefault['id']}";
		  if(mysql_query($updateQuery, $connection))
		  {
			$output="<div class=\"alert alert-success\">
				Edit successful.
				</div>";
			$url = "index.php";//change this as per requirement
			$output .= "<META HTTP-EQUIV=\"refresh\" CONTENT=\"2;URL={$url}\">";
			echo $output;
		  }
		  else
		  {
			$output="<div class=\"alert alert-error\">
				update failed, check details and try again.
				</div>";
			echo $output;
		  }
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