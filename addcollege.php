<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
    //method to add a college to the database
    function addCollege($college)
    {
        global $connection;
        $query="INSERT INTO colleges(name) VALUES('{$college}')";
        if(mysql_query($query,$connection))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
?>

<div class="wrapper">
    <?php
    //Prints nav bar
      $nav = printNav(true);
      echo $nav;
    ?>
    <div class="wrapper-content">
      <div class="well">
        <form method="get" action="addcollege.php">
            <input type="text" name="college" required>
            <input type="submit" name="submit"/>
        </form>
        <div>
            <?php
                if(isset($_GET['submit']))
                {
                    $college=$_GET['college'];
                    echo $college;
                    if(addCollege($college))
                    {
                        echo "success";
                    }
                    else
                    {
                        echo "failed";
                    }
                }
            ?>
        </div>
      </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>