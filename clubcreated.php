
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
    $clubName=$_POST['clubName'];
    $college=$_POST['college'];
    $category=$_POST['category'];
    $url=$_POST['url'];
    $description=$_POST['description'];
    $query="INSERT INTO CLUBS(clubName,college,category,url,description) VALUES('{$clubName}','{$college}','{$category}','{$url}','{$description}')";
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