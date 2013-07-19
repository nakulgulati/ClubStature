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
  <h1>
    <b>Look for groups by institute and organization type. </b> 
  </h1>
  <h4> Please enter something other than "None" in <i>both</i> search fields</h4> 
  
  <?php
		if( isset($_GET['submitFilter']) ){
			echo "you've submitted something, bitches! ";
			echo "<br>";
			
			$collegeName = $_GET["collegeName"];
			$clubtype = $_GET["clubtype"];
			
			
			if ( ($collegeName == "None") or ($clubtype == "None") ){ //when they're not looking for anything
				echo "Please search for <i>something</i> in <i>both</i> fields!";
			}
			
			elseif( ($collegeName == "All") and ($clubtype == "All") ){  //when they're looking for EVERYTHING
				echo "Do us both a favor and narrow down your search criteria, will you?";
			}
			
			
			else {  //when you're not asking for all or nothing
				echo "Thanks for asking for something actually legit. <br>";
				
				if ($collegeName == "All"){  //when the user asks for all clubs of one type across different colleges. clubtype cannot be all.
					$query = "SELECT * FROM clubs WHERE category='{$clubtype}'";
					global $connection;
					$displayResults = "";
					$resultset=mysql_query($query, $connection);
					while ($row = mysql_fetch_array($resultset)){
						$displayResults= $row['clubName'];//AMIT, THIS IS WHERE YOU SCREWED UP...
						echo $displayResults;//YOU CONCATTED WITHOUT RESETING THE STRING...
						echo "<br/>";
						//SO YOUR RESULT WAS RECURSIVE IE 1,2,3 BECAME 1,12,123
					}
				} 
				
				elseif ($clubtype == "All"){  //when the user asks for all clubs from one college/institute. collegeName cannot be all.
					$query = "SELECT * FROM clubs WHERE college='{$collegeName}'";
					global $connection;
					$displayResults = ""; 
					$resultset=mysql_query($query, $connection);
					while ($row = mysql_fetch_array($resultset)){
						$displayResults= $row['clubName'];
						echo $displayResults;
						echo "<br/>";
					}
				}
				
				else {
					echo "Finally! We're getting to the specifics now, aren't we? <br>";
					$query = "SELECT * FROM clubs WHERE college='{$collegeName}' AND category='{$clubtype}'";
					global $connection;
					$displayResults = "";
					$resultset=mysql_query($query, $connection);
					while ($row = mysql_fetch_array($resultset)){
						$displayResults= $row['clubName'];
						echo $displayResults;
						echo "<br/>";
					}
				}
				
			
			
			}			
		
		
		}

	?>
  
  <form method = "get">
  
  
  <h3>College or School</h3>
		  
		  <?php //getting the list of college names into the dropdown here
		  
		  $query = "SELECT * FROM colleges ORDER BY name ASC" ;
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
			<select name="clubtype">
			<option> None </option>
			<option> All </option>
			<option> Sports and Recreation </option>
			<option> Art, Dance and Music </option>
			<option> Academic/Professional </option>
			<option> Community Service/Volunteering </option>
			<option> Governance </option>
			<option> Greek Life </option>
			<option> Science and Technology </option>
			<option> Lifestyle and Culture </option>
			</select>
			
			<input type="submit" value="Submit" name = "submitFilter">
			</form>
      </div>
  </div>
  
 
  <div class="control-group"></div>
</div>
</div>
</div>
<?php include("includes/footer.php"); ?>