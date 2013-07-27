<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php

    $result=getData("users","*","username","{$_SESSION['username']}");
    $row1=mysql_fetch_array($result);
    
    if(isset($_POST['submit']))
    {
        echo print_r($_POST['clubs']);
        userupdate($_POST['username'],$_POST['email'],$_POST['college'],$_POST['clubs']);
    }
    //club is array
  function userupdate($username,$email,$college,$club)
  {
    
    global $connection;
    if($college=="")
    {
      $college=NULL;
    }
    $query="UPDATE users SET email='{$email}',college='{$college}' WHERE username='{$username}'";
    mysql_query($query,$connection);
    if($club[0]!=""&&$club[0]!=NULL)
    {
        $query="SELECT * FROM users WHERE username='{$username}'";
        $result=mysql_query($query,$connection);
        $row=mysql_fetch_array($result);
        $oldclub=$row['clubs'];
        foreach($club as $var)
        {
            if(!stripos($oldclub,$var))
            {
                $oldclub.=",".$var;
            }
        }
        $query="UPDATE users SET clubs='{$oldclub}' WHERE username='{$username}'";
        mysql_query($query,$connection);
    }
  }
?>
<html>
    <form class="form-inline" name="test" action="userupdate.php" method="POST">
        <input type="text" name="username" value="<?php echo $row1['username']; ?>"/>
        <input type="text" name="email" value="<?php echo $row1['email']; ?>"/>
        <input type="text" name="college" value="<?php echo $row1['college']; ?>"/>
        <p><?php echo $row1['clubs'] ?></p>
        <select name="clubs[]" multiple="multiple">
            <?php
            $output= "";
            //geting the list of colleges
            $resultSet = getData("clubs","clubName");
            while($row = mysql_fetch_array($resultSet))
            {
                $output .= "<option>{$row['clubName']}</option>";
            }
            echo $output;
            ?>
        </select>
        <input type="submit" name="submit"/>
    </form>
</html>
<?php include("includes/footer.php"); ?>