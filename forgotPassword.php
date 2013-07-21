<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
////Prints nav bar
//  $nav = printNav(true);
//  echo $nav;
?>

<?php
    $inp=false;
    
    
    
    function resetPassword($username,$emailId)
    {
        global $connection;
        $result = getData("users","*","username",$username);
        echo "hello!";
        if(mysql_num_rows($result)!=0)
        {
            $row=mysql_fetch_array($result);
            $datEmail=$row['email'];
            echo $datEmail;
            if($datEmail==$emailId)
            {
                echo "match!";
                
                $randomNo = rand(100,100000);
                $hash1=sha1($randomNo);
                $pass=substr($hash1,0,7);
                $hashPass=sha1($pass);
                $query="UPDATE users SET hashedPass = '{$hashPass}' WHERE username = '{$username}'";
                if(mysql_query($query,$connection))
                {
                    echo "password reset to {$pass}";
                    //mail stuff
                    //$to=$emailId;
                    //$subject="password reset for your account";
                    //$message="Dear {$username}, \n As requested, your account password has been reset to {$pass} please go ";
                    //mail($to,$subject,$message);
                    
                }
                else{
                    echo "failed";
                }
                $inp=true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
?>

<div class="wrapper">
  <div class="container">
    <div class="hero-unit hidden-phone">
        
        <form name="resetInp" action="forgotPassword.php" method="GET" enctype="">
            <label class="control-label" for="name">Username</label>
            <input type="text" name="name" size="15" required/>
            <br/>
            <label class="control-label" for="email">Email-ID</label>
            <input type="text" name="email" size="15" required/>
            <br/>
            <hr>
            <input type="submit" name="submit"/>
        </form>
        
        <?php
            
            if(isset($_GET['submit']))
            {
                resetPassword($_GET['name'],$_GET['email']);
            }
            
            //if($inp)
            //{
            //    echo "match";
            //}
            //else
            //{
            //    echo "enter your username and matching email id";
            //}
        ?>
        
    </div>
  </div>
</div>
            
            
<?php include("includes/footer.php"); ?>