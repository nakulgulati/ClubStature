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
$inp=false;
if(isset($_GET['submit']))
{
    global $connection;
    
    $name=$_GET['clubname'];
    $name=mysql_real_escape_string($name);
    //$name=htmlentities($name);
    $query="INSERT INTO CLUBS(CLUBNAME) VALUES('{$name}')";
    if($res=mysql_query($query,$connection))
    $inp=true;
}
?>

<div class="wrapper">
  <div class="container">
    <div class="hero-unit hidden-phone">
      <!--body content here-->
      <form name="test" action="testForm.php" method="GET">
        <input name="clubname" type="text">
        <input type = "submit" name="submit">
            
      </form>
            <?php
            if($inp)
            {
                $query="SELECT * FROM CLUBS WHERE CLUBNAME='{$name}'";
                $result=mysql_query($query,$connection);
                $row=mysql_fetch_array($result);
                $name=$row['clubName'];
                echo $name;
            }
            else
            {
                echo "failed";
            }
            ?>
    </div>
  </div>
</div>
            
            
<?php include("includes/footer.php"); ?>