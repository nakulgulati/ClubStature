<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
    if(!loggedIn()) {
	redirect_to("index.php");
}
?>

<?php
    //getting user details
    $userDetails = getData("users","*","username",$_SESSION['username']);
    $user = mysql_fetch_array($userDetails);
    
    //getting list of colleges
    $collegeSet = getData("colleges","name");
    
    //getting list of category
    $categorySet = getData("categoryname","category");
    
    //getting list of user made clubs
    $userClubSet = getData("clubs","*","creator",$_SESSION['username']);
    
    if(isset($_POST['transfer']) || isset($_POST['edit'])){
	$editClubSet = getData("clubs","*","clubName",$_POST['clubSelect']);
	$_SESSION['selectedClub'] = $_POST['clubSelect'];
	$club = mysql_fetch_array($editClubSet);
    }
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
    
    if(isset($_POST['deleteAccount'])){
	
	$errors = deleteAccount($_SESSION['username'],$_POST['pass']);
	//show message
	//redirect
    }
    
    function updateClub($clubName,$creator,$newClubName,$newCategory,$newUrl,$newDesc){
	global $connection;
	$updates = 0;
	
	$userClubSet = getData("clubs","*","clubName",$_SESSION['selectedClub']);
	$club = mysql_fetch_array($userClubSet);
	
	if(($newClubName!=$club['clubName']) || ($newCategory!=$club['category']) || ($newUrl!=$club['url']) || ($newDesc!=$club['description'])){
	    $updates++;
	}
	
	if($updates!=0){
	    $query = "UPDATE clubs SET clubName = '{$newClubName}', category = '{$newCategory}', url = '{$newUrl}', description = '{$newDesc}';";
	    mysql_query($query,$connection);
	}
	return $updates;
    }
    
    if(isset($_POST['updateClub'])){
	$update = updateClub($_SESSION['selectedClub'],$_SESSION['username'],$_POST['newClubName'],$_POST['newCategory'],$_POST['newUrl'],$_POST['newDesc']);
    }
?>

<div class="wrapper">
    <?php
    //Prints nav bar
      $nav = printNav(false);
      echo $nav;
    ?>
    <div class="wrapper-content">
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
				
				if(isset($_SESSION['status'])){
				    if($_SESSION['status']==1){
					echo "<div class=\"alert alert-success\">
					    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
					    <strong>Server:</strong> Information has been updated. :)
					    </div>";
					$_SESSION['status']=0;
				    }
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
					<select class=\"form-control\" id=\"collegeList\" name=\"newCollege\">";
					
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
			    elseif($_GET['option']=="deleteAccount"){
				
				echo "<h3>Delete Account</h3>";
				
				if(isset($_POST['deleteAccount'])){
				    if($errors['status']==1){
					$output="<div class=\"alert alert-success\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
						<strong>Server: </strong> Account deletion in progress. You will be redirected on completion.
						</div>
						<META HTTP-EQUIV=\"refresh\" CONTENT=\"2;URL=logout.php\">";
					echo $output;
				    }
				    elseif(($errors['status']==0)){
					$output="<div class=\"alert alert-danger\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
						<strong>Server: </strong>
						Incorrect password";
					$output.= "</div>";
					echo $output;
				    }
				}
				
				$output="<form class=\"form-horizontal\" method=\"post\" action=\"user.php?option=deleteAccount\">
				       <div class=\"form-group\">
				       <label for=\"pass\" class=\"col-lg-2 control-label\">Enter your Password</label>
				       <div class=\"col-lg-6\">
				       <input type=\"password\" class=\"form-control\" id=\"pass\" name=\"pass\" placeholder=\"Your Password\">
				       <br>
				       <button type=\"submit\" name=\"deleteAccount\" class=\"btn btn-danger\">Delete Account</button>
				       </div>
				       </div>
				       </form>";
				echo $output;
			    }
			    elseif($_GET['option']=="joinClubs"){
				echo "<h3>Join Clubs</h3>";
				$output="";
			    }
			    elseif($_GET['option']=="editClubs"){
				echo "<h3>Edit Club Details</h3>";
				
				if(isset($_POST['transfer'])){
				    echo "transfer";				    
				}
				elseif(isset($_POST['edit'])){
								    
				    $output="<div class=\"col-lg-4\" id=\"newImg\">
					    <img src=\"img/no-image.gif\">
					    </div>
					    <div class=\"col-lg-8\" id=\"updateForm\">
					    <form class=\"form-horizontal\" method=\"post\" action=\"user.php?option=editClubs\">
					    <div class=\"form-group\">
					    <label for=\"newClubName\" class=\"col-lg-2 control-label\">Club Name</label>
					    <div class=\"col-lg-9\">
					    <input type=\"text\" class=\"form-control\" id=\"newClubName\" name=\"newClubName\" placeholder=\"Club Name\" value=\"{$club['clubName']}\">
					    </div>
					    </div>";
					    //category
					    
				    $output.="<div class=\"form-group\">
					    <label for=\"newCategory\" class=\"col-lg-2 control-label\">Category</label>
					    <div class=\"col-lg-9\">
					    <select class=\"form-control\" id=\"newCategory\" name=\"newCategory\">";
					    
				    while($category=mysql_fetch_array($categorySet)){
					$output.="<option";
					if($club['category']==$category['category']){
					    $output.=" selected=\"selected\"";
					}
					$output.=">{$category['category']}</option>";
				    }
				
				    $output.="</select>
					    </div>
					    </div>
					    <div class=\"form-group\">
					    <label for=\"newUrl\" class=\"col-lg-2 control-label\">Url</label>
					    <div class=\"col-lg-9\">
					    <input type=\"text\" class=\"form-control\" id=\"newUrl\" name=\"newUrl\" placeholder=\"Club Url/Facebook Page\" value=\"{$club['url']}\">
					    </div>
					    </div>";
					    
				    $output.="<div class=\"form-group\">
					    <label for=\"newDesc\" class=\"col-lg-2 control-label\">Description</label>
					    <div class=\"col-lg-9\">
					    <textarea class=\"form-control\" name=\"newDesc\" placeholder=\"Club Description\" required>{$club['description']}</textarea>
					    </div>
					    </div>";
					    
				    
				    $output.="<div class=\"form-group\">
					    <div class=\"col-lg-9 col-offset-2\">
					    <button type=\"submit\" name=\"updateClub\" class=\"btn btn-default\">Update</button>
					    </div>
					    </div>
					    </form>
					    </div>";
				    
				    echo $output;
				}
				else{
				    $output="<form class=\"form-horizontal\" method=\"post\" action=\"user.php?option=editClubs\">
				       <div class=\"form-group\">
				       <label for=\"clubSelect\" class=\"col-lg-2 control-label\">Select a Club</label>
				       <div class=\"col-lg-6\">
				       <select class=\"form-control\" id=\"clubSelect\" name=\"clubSelect\">";
					
				    while($userClub=mysql_fetch_array($userClubSet)){
					$output.="<option>{$userClub['clubName']}</option>";
				    }
				
				    $output.="</select> 
					    <br>
					    <button type=\"submit\" name=\"edit\" class=\"btn btn-primary\">Edit CLub</button>
					    <button type=\"submit\" name=\"transfer\" class=\"btn btn-warning\">Transfer Club</button>
					    </div>
					    </div>
					    </form>";
				    echo $output;    
				}
				
				
				
			    }
			    elseif($_GET['option']=="deleteClubs"){
				echo "<h3>Delete Clubs</h3>";
			    }
			}
		    ?>
		</div>
	    </div>
	</div>
    </div>
</div>


<?php include("includes/footer.php"); ?>