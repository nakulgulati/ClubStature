<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
        
    $errors = array();
    
    if(isset($_POST['sendCode'])){
        $resetCode = generateNewPassword($_POST['email']);
        
        $userDetails = getData("users","*","email",$_POST['email']);
        $user = mysql_fetch_array($userDetails);
        
        if($resetCode!=-1){
            $resetUrl = "www.clubstature.com/forgotPassword.php?section=resetPass&email={$_POST['email']}&resetCode={$resetCode}";
            sendMail($user['id'],"change","www.clubstature.com/forgotPassword.php?section=resetPass&email={$_POST['email']}&resetCode={$resetCode}");       
        }
        else{
            array_push($errors,"Enter a valid email");
        }
    }
    
    if(isset($_POST['setPass'])){
        if(isset($_GET['email']) && isset($_GET['resetCode'])){
            $errors = updateNewPassword($_GET['resetCode'],$_POST['newPass'],$_POST['verifyNewPass']);
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
        <div class="container">
    
        <?php
            if(isset($_GET['section'])){
                $output="";
                if($_GET['section']=="genCode"){
                    $output.="<h1 class=\"page-header\">Forgot Password</h1>
                            <form class=\"form-horizontal\" action=\"forgotPassword.php?section=genCode\" method=\"post\">
                            <div class=\"form-group\">
                            <label for=\"email\" class=\"col-lg-2 control-label\">Email</label>
                            <div class=\"col-lg-3\">
                            <input type=\"text\" class=\"form-control\" id=\"email\" name=\"email\" placeholder=\"Email\">
                            <span class=\"help-block\">Enter your email to reset password.</span>
                            <button type=\"submit\" class=\"btn btn-default\" name=\"sendCode\">Send Password Reset Code</button>
                            </div>
                            </div>
                            </form>";
                            
                    echo $output;
                }
                elseif($_GET['section']=="resetPass"){
                    if(isset($_GET['resetCode']) && isset($_GET['email'])){
                        $output.="<h1 class=\"page-header\">Reset Password</h1>
                                <form class=\"form-horizontal\" action=\"{$_SERVER['HTTP_REFERER']}\" method=\"post\">
                                <div class=\"form-group\">
                                <label for=\"newPass\" class=\"col-lg-2 control-label\">Enter New Password</label>
                                <div class=\"col-lg-3\">
                                <input type=\"password\" class=\"form-control\" id=\"email\" name=\"newPass\" placeholder=\"New password\">
                                </div>
                                </div>
                                <div class=\"form-group\">
                                <label for=\"verifyNewPass\" class=\"col-lg-2 control-label\">Verify New Password</label>
                                <div class=\"col-lg-3\">
                                <input type=\"password\" class=\"form-control\" id=\"verifyNewPass\" name=\"verifyNewPass\" placeholder=\"What's up there ^\">
                                <br>
                                <button type=\"submit\" class=\"btn btn-default\" name=\"setPass\">Reset Password</button>
                                </div>
                                </div>
                                </form>";
                                
                        echo $output;
                    }
                }
            }
        ?>
        
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>