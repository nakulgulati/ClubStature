<?php
$show=false;
$message="";
if(isset($_POST['submit']))
{
    echo "hi";
    $show=true;
    if ($_FILES["file"]["error"] > 0)
    {
        $message.="Error: " . $_FILES["file"]["error"] . "<br>";
    }
    else
    {
        $allowedExts = array("gif", "jpeg", "jpg", "png","JPEG"."GIF","JPG","PNG");
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);
        if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/x-png")
        || ($_FILES["file"]["type"] == "image/png"))
        && in_array($extension, $allowedExts))
        {
          
            $message.="Upload: " . $_FILES["file"]["name"] . "<br>";
            $message.="Type: " . $_FILES["file"]["type"] . "<br>";
            $message.="Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
            $message.="Stored in: " . $_FILES["file"]["tmp_name"];
            move_uploaded_file($_FILES["file"]["tmp_name"],
            "upload/" . $_FILES["file"]["name"]);
            $message.="Stored in: " . "upload/" . $_FILES["file"]["name"];
        }
        else
        {
          echo "Invalid file";
        }
    }
}

?>
<html>
    <form name="filelaod" action="fileloader.php" method="POST"  enctype="multipart/form-data" required>
        <input type="file" name="file" id="file" required/>
        <input type="submit" name="submit" value="submit"/>
    </form>
    <br/>
    
    <?php
    if($show)
    {
        echo $message;
    }
    ?>
</html>
