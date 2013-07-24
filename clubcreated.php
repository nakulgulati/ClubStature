
<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
//Prints nav bar
  //$nav = printNav(true);
  //echo $nav;
?>
<?php
    $clubName=$_POST['clubName'];
    $college=$_POST['college'];
    $category=$_POST['category'];
    $url=$_POST['url'];
    $description=$_POST['description'];
    $fileName = $_FILES["file"]["name"];
    
  
    
    $allowedExts = array("gif", "jpeg", "jpg", "png", "PNG", "JPEG", "GIF", "JPG");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);  

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
			echo "Upload: " . $_FILES["file"]["name"] . "<br>";
			echo "Type: " . $_FILES["file"]["type"] . "<br>";
			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

			if (file_exists("images/" . $_FILES["file"]["name"])){
				echo $_FILES["file"]["name"] . " already exists. ";
			}
			else{
				move_uploaded_file($_FILES["file"]["tmp_name"], "images/".$_FILES["file"]["name"]);
				echo "Stored in: " . "images/" . $_FILES["file"]["name"];
				}
		}
	}
	else{
		echo "Invalid file";
	}
        
        $query="INSERT INTO clubs(clubName,college,category,url,description,image) VALUES('{$clubName}','{$college}','{$category}','{$url}','{$description}','{$fileName}')";

    if(mysql_query($query,$connection))
    {
        echo "success";
    }
    else{
        echo "failed";
    }
    
    
    
?>
<div class="wrapper">
  <div class="container">
    <div class="hero-unit hidden-phone">
      <!--body content here-->
      <div class="container">
        <h1>Your Club Has Been Created!</h1>
        <p><b>Your Club Request has been successfully received and is being processed...</b></p>
        </div>
    </div>
  </div>
</div>
            
            
<?php include("includes/footer.php"); ?>