<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<div class="wrapper">
    
    <?php
    //Prints nav bar
      $nav = printNav(true);
      echo $nav;
    ?>

    <div class="wrapper-content">
	<div class="container">
	    <h1 class="page-header">Add a Club</h1>
	    <form class="form-horizontal" method="post" action="addClub.php" enctype="multipart/form-data">
		<div class="form-group">
		    <label for="clubName" class="col-lg-2 control-label">Name of Club</label>
		    <div class="col-lg-6">
			<input type="text" class="form-control" id="clubName" name="clubName" placeholder="Club name" required>
		    </div>
		</div>
		<div class="form-group">
		    <label for="category" class="col-lg-2 control-label">Category</label>
		    <div class="col-lg-6">
		    <?php
			$output = "<select class=\"form-control\" name =\"category\">";
			//$output.= "<option></option> ";
			//getting the list of categories
			$resultSet = getData("categoryname","category");
			while($row = mysql_fetch_array($resultSet)){
			    $output .= "<option>{$row['category']}</option>";
			}
			
			$output .= " </select>";
			echo $output;
		    ?>
		    </div>
		</div>
		
		<div class="form-group">
		    <label for="college" class="col-lg-2 control-label">College</label>
		    <div class="col-lg-6">
			<?php
			    $output = "<select class=\"form-control\" name =\"college\">";
			    $query = "SELECT name FROM colleges ORDER BY name";
			    //$output.= "<option></option>";
			    //getting the list of colleges
			    $resultset = mysql_query($query, $connection);
			    //$resultSet = getData("colleges","name");
			    while($row = mysql_fetch_array($resultset)){
				$output .= "<option>{$row['name']}</option>";
			    }
			
			    $output .= " </select>";
			    echo $output;
			?>
		    </div>
		</div>
		<div class="form-group">
		    <label for="url" class="col-lg-2 control-label">Club Url</label>
		    <div class="col-lg-6">
			<input type="url" class="form-control" id="url" name="url" placeholder="club url" required>
		    </div>
		</div>
		
		<div class="form-group">
		    <label for="file" class="col-lg-2 control-label">Club Logo</label>
		    <div class="col-lg-6">
			<input class="form-control" type="file" name="file" id="file">
		    </div>
		</div>
		
		<div class="form-group">
		    <label for="file" class="col-lg-2 control-label">Description</label>
		    <div class="col-lg-6">
			<textarea class="form-control" name="description" class="input-block-level" required></textarea><br>
			<button type="submit" class="btn btn-primary" value="Create Club" name="addClub">Create Club</button>
		    </div>
		</div>
	    </form>
	</div>
    </div>
</div>




<?php
    if(isset($_POST['addClub'])){
      $clubName=$_POST['clubName'];
      $college=$_POST['college'];
      $category=$_POST['category'];
      $url=$_POST['url'];
      $description=$_POST['description'];
      $fileName = $_FILES["file"]["name"];
      $userInformation = getUserInfo($_SESSION['userId']);
      $creatorName = $userInformation['username'];
    
      $fileName = uploadFile($fileName,$clubName);

          if (isCombinationUnique("clubs","college","clubName",$college,$clubName) and (loggedIn())  ){
            $query="INSERT INTO clubs(clubName,college,category,url,description,image,creator)   
            VALUES('{$clubName}','{$college}','{$category}','{$url}','{$description}','{$fileName}','{$creatorName}')";
            mysql_query($query,$connection);
            $output="<div class=\"alert alert-success\">
            Club Creation successful!
            </div>";
            echo $output;
            }

    else{
          $output="<div class=\"alert alert-error\">
          Club addition failed: You are either not logged in, or a duplicate organization exists.
          </div>";
          echo $output;
      //echo "You've entered a duplicate club";
    }
}
?>
    
<?php include("includes/footer.php"); ?>