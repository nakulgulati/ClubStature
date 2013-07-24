<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
if(loggedIn()){        
    if(isset($_POST['submitdelete'])){
	$user= $_SESSION['username'];
	$query = "SELECT hashedPass FROM users WHERE username = '{$user}'";
	$result = mysql_query($query, $connection);
	$row = mysql_fetch_array($result);
	$hashedPass = $row['hashedPass']; 
	$password = sha1($_POST["goodbyepassword"]);
	
	if($password==$hashedPass){	    
	    $query="DELETE FROM users WHERE username='{$user}'";
	    mysql_query($query, $connection);
	    
	    $_SESSION = array();
	    
	    if(isset($_COOKIE[session_name()])){
		setcookie(session_name(), '', time()-42000, '/');
	    }
	    
	    session_destroy(); //Destroy the session
	}
	else{
	    echo "We're sorry; we can't delete your account without proper credentials.";
	}
    }
}
else{
    //redirect_to("index.php");
}
?>


<div class="wrapper">
    <div class="container">
	<div class = "row">
	    
		<?php
		$output = "";
		if(loggedIn()){
		    $output="<div class = \"span7\">
			    <form class=\"form-horizontal\" method=\"POST\" action=\"deleteAccount.php\">
			    <legend>
			    So you wanna delete your account, {$_SESSION['username']}?
			    </legend>
			    <div class=\"control-group\">
			    <label class=\"control-label\">First type your password</label>
			    <div class=\"controls\">
			    <input type=\"password\" name=\"goodbyepassword\" placeholder=\"Your password, please.\" required>
			    </div>
			    </div>
			    <input type=\"submit\" name=\"submitdelete\">
			    </form>
			    </div>"; 
		}
		elseif(isset($_POST['submitdelete'])){
		    $output="<div class=\"alert alert-success\">
				<h3>You have successfully deleted your account.</h3>
			    </div>
			    <META HTTP-EQUIV=\"refresh\" CONTENT=\"2;URL=index.php\">";
		}
		else{
		    $output="<div class=\"alert alert-warning\">
			    <h3>You should be logged in to access this page</h3><br>
			    Redirecting...
			    </div>
			    <META HTTP-EQUIV=\"refresh\" CONTENT=\"2;URL=index.php\">";
		}
		echo $output;
		?>
	    
	</div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
