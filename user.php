<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
    if(!loggedIn()) {
	redirect_to("{$_SERVER['REQUEST_URI']}");
}
?>

<?php
//Prints nav bar
  $nav = printNav(false);
  echo $nav;
?>

<?php
    //getting user details
    $userDetails = getData("users","*","username",$_SESSION['username']);
    $user = mysql_fetch_array($userDetails);
    
    //getting list of colleges
    $collegeSet = getData("colleges","name");
?>
<?php
    if(isset($_POST['updateDetails'])){
	$_SESSION['status'] = updateInfo($_SESSION['username'],$_POST['newName'],$_POST['newEmail'],$_POST['newCollege']);
	if($_SESSION['status']){
	    redirect_to("user.php?option=profile");
	}
    }
    
    if(isset($_POST['changePass'])){
	$errors = changePassword($_SESSION['username'],$_POST['oldPass'],$_POST['newPass'],$_POST['verifyNewPass']);
    }
?>

<div class="wrapper">
    <div class="container">
	<div class="row">
	    <div class="well col-lg-3">
		<!--side nav-->
		<?php
		    if(isset($_GET['option'])){
			printUserNav($_GET['option']);
		    }
		?>
	    </div>
	    <div class="well col-offset-1 col-lg-8">
		<!--main content-->
		<?php
		    if(isset($_GET['option'])){
			if($_GET['option']=="profile"){
			    echo "<h3>Account Information</h3>";
			    
			    if(($_SESSION['status']==1) && isset($_SESSION['status'])){
				echo "<div class=\"alert alert-success\">
				    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
				    <strong>Server:</strong> Information has been updated. :)
				    </div>";
				$_SESSION['status']=0;
			    }
			    
			    echo "<table>
				<tr><td>Username:</td><td>{$user['username']}</td></tr>
				<tr><td>Name:</td><td>{$user['name']}</td></tr>
				<tr><td>Email:</td><td>{$user['email']}</td></tr>
				<tr><td>College:</td><td>{$user['college']}</td></tr>
				</table>";
			    
			}
			elseif($_GET['option']=="editProfile"){
			    echo "<h3>Edit Account Details</h3>";
			    $output="<form class=\"form-horizontal\" method=\"post\" action=\"user.php?option=editProfile\">
				    <div class=\"form-group\">
				    <label for=\"name\" class=\"col-lg-2 control-label\">Name</label>
				    <div class=\"col-lg-6\">
				    <input type=\"text\" class=\"form-control\" id=\"name\" name=\"newName\" placeholder=\"Your Name\" value=\"{$user['name']}\">
				    </div>
				    </div>";
			    $output.="<div class=\"form-group\">
				    <label for=\"email\" class=\"col-lg-2 control-label\">Email</label>
				    <div class=\"col-lg-6\">
				    <input type=\"email\" class=\"form-control\" id=\"email\" name=\"newEmail\" placeholder=\"Your Email\" value=\"{$user['email']}\">
				    </div>
				    </div>";
				    
			    $output.="<div class=\"form-group\">
				    <label for=\"collegeList\" class=\"col-lg-2 control-label\">College</label>
				    <div class=\"col-lg-6\">
				    <select class=\"form-control\" id=\"collegeList\" name=\"newCollege\">
				    <option></option>";
				    
			    while($college=mysql_fetch_array($collegeSet)){
				$output.="<option";
				if($college['name']==$user['college']){
				    $output.=" selected=\"selected\"";
				}
				$output.=">{$college['name']}</option>";
			    }
			    
			    $output.="</select>
				    </div>
				    </div>
				    <div class=\"form-group\">
				    <div class=\"col-lg-6 col-offset-2\">
				    <button type=\"submit\" name=\"updateDetails\" class=\"btn btn-default\">Update</button>
				    </div>
				    </div>
				    </form>";
			    
			    echo $output;
			}
			elseif($_GET['option']=="changePass"){
			    
			    echo "<h3>Change Password</h3>";
			    
			    if(isset($_POST['changePass'])){
				if($errors['status']==1){
				    $output="<div class=\"alert alert-success\">
					    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
					    <strong>Server: </strong> {$errors[0]} :)
					    </div>";
				    echo $output;
				}
				elseif(($errors['status']==0) && (count($errors)>1)){
				    $output="<div class=\"alert alert-danger\">
					    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
					    <strong>Server: </strong>";
				    foreach($errors as $key => $value){
					if($value != '0'){
					    $output .= $value."<br>";
					}	
				    }
				    $output	.= "</div>";
				    echo $output;
				}
			    }
			    $output="<form class=\"form-horizontal\" method=\"post\" action=\"user.php?option=changePass\">
				   <div class=\"form-group\">
				   <label for=\"oldPass\" class=\"col-lg-2 control-label\">Old Password</label>
				   <div class=\"col-lg-6\">
				   <input type=\"password\" class=\"form-control\" id=\"oldPass\" name=\"oldPass\" placeholder=\"Old password\">
				   </div>
				   </div>";
			   $output.="<div class=\"form-group\">
				   <label for=\"newPass\" class=\"col-lg-2 control-label\">New Password</label>
				   <div class=\"col-lg-6\">
				   <input type=\"password\" class=\"form-control\" id=\"newPass\" name=\"newPass\" placeholder=\"New password\">
				   </div>
				   </div>";
			    $output.="<div class=\"form-group\">
				   <label for=\"verifyNewPass\" class=\"col-lg-2 control-label\">Verify New Password</label>
				   <div class=\"col-lg-6\">
				   <input type=\"password\" class=\"form-control\" id=\"verifyNewPass\" name=\"verifyNewPass\" placeholder=\"What's up there ^\">
				   </div>
				   </div>";
			    $output.="<div class=\"form-group\">
				    <div class=\"col-lg-6 col-offset-2\">
				    <button type=\"submit\" name=\"changePass\" class=\"btn btn-default\">Change Password</button>
				    </div>
				    </div>
				    </form>";
			    echo $output;
			}
		    }
		?>
	    </div>
	</div>
    </div>
</div>


<?php include("includes/footer.php"); ?>