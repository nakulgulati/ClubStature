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
    function uploadFile($fileName,$clubName){
	
	global $connection;
	
	$allowedExts = array("gif", "jpeg", "jpg", "png", "PNG", "JPEG", "GIF", "JPG");
	$temp = explode(".", $fileName);
	$extension = end($temp);
	
	$query = "SELECT COUNT(id) AS total FROM clubs";
	$resultSet = mysql_query($query,$connection);
	$row = mysql_fetch_array($resultSet);
	$id = $row['total'];
	$id++;
	
	$newName = $id."-".str_replace(" ","",$clubName);
	
	if ((($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/jpg")
	|| ($_FILES["file"]["type"] == "image/pjpeg")
	|| ($_FILES["file"]["type"] == "image/x-png")
	|| ($_FILES["file"]["type"] == "image/png"))
	&& ($_FILES["file"]["size"] < 1000000) //file size less than 1000 kB or 1 MB
	&& in_array($extension, $allowedExts)) {
		if($_FILES["file"]["error"] > 0){
			echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
		}
		else {			
			move_uploaded_file($_FILES["file"]["tmp_name"], "img/clubImages/".$newName);
			return $newName;
    		}
	}
    }
?>

<?php
if(isset($_POST['addClub'])){
    $clubName=$_POST['clubName'];
    $college=$_POST['college'];
    $category=$_POST['category'];
    $url=$_POST['url'];
    $description=$_POST['description'];
    $fileName = $_FILES["file"]["name"];
    
    
    $fileName = uploadFile($fileName,$clubName);

    $query="INSERT INTO clubs(clubName,college,category,url,description,image) VALUES('{$clubName}','{$college}','{$category}','{$url}','{$description}','{$fileName}')";

    mysql_query($query,$connection);
}
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
              <form method="post" action="addClub.php" enctype="multipart/form-data">
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
        <input type="submit" class="btn btn-primary" value="Create Club" name="addClub">
        <input type="reset" class="btn" value="Reset">
      	<!--<input type="submit" class="btn btn-primary" value="Request Club" name="clubRequested">--> 
            
      </div>
    </div>
      </form>
	  
</div>
<?php include("includes/footer.php"); ?>