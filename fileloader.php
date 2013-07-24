<?php

if(isset($_POST['submit'])){
$allowedExts = array("gif", "jpeg", "jpg", "png", "PNG", "JPEG", "GIF", "JPG");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

  $fileName = $_FILES["file"]["name"];
    
    echo $fileName;

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

}
?>
<html>
    <form method="POST"  enctype="multipart/form-data" required>
        <input type="file" name="file" id="file">
        <input type="submit" name="submit" value="submit"/>
    </form>
    <br/>
</html>
