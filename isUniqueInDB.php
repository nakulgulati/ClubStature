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
//Prints nav bar
  $nav = printNav(true);
  echo $nav;
?>

<div class="wrapper">
  <div class="container">
    <div class="hero-unit hidden-phone">
      <!--body content here-->
      <?php
        
        if(isUniqueInDB("clubs","clubname","Michigan Hackers"))
        {
            echo "unique";
        }
        else
        {
            echo "repeat";
        }
        echo "<br/>";
        if(isUniqueInDB2("Michigan","Michigan Hackers"))
        {
            echo "unique";
        }
        else
        {
            echo "repeat";
        }
        
        //function to determine if club name is unique
        function isUniqueInDB($tableName,$field,$value)
        {
            global $connection;
            if($tableName!="clubs")
            {
                $query="SELECT * FROM {$tableName} WHERE {$field} = '{$value}'";
                $result=mysql_query($query,$connection);
                $var= mysql_num_rows($result);
                if($var>=1)
                {
                    return false;
                }
                else
                {
                    return true;
                }
            }
            else
            {
                $query="SELECT * FROM clubs WHERE clubname = '{$clubname}' and college = '{$college}'";
                $result=mysql_query($query,$connection);
                $var= mysql_num_rows($result);
                if($var>=1)
                {
                   return false;
                }
                else
                {
                    return true;
                }
            }
        }
        
        //function to determine if club name is unique in given college
        function isUniqueInDB2($college,$clubname)
        {
            global $connection;
            $query="SELECT * FROM clubs WHERE clubname = '{$clubname}' and college = '{$college}'";
            $result=mysql_query($query,$connection);
            $var= mysql_num_rows($result);
            if($var>=1)
            {
                return false;
            }
            else
            {
                return true;
            }
        }
?>
    </div>
  </div>
</div>
            
            
<?php include("includes/footer.php"); ?>