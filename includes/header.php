<?php ob_start();
	date_default_timezone_set("Asia/Calcutta");
?>
<?php
    $title = "";
    $self = $_SERVER['PHP_SELF'];
    
    if(strpos($self,"index.php")){
	$title = "";
    }
    elseif(strpos($self,"about.php")){
	$title = " - About";
    }
    elseif(strpos($self,"login.php")){
	$title = " - Login";
    }
    elseif(strpos($self,"signup.php")){
	$title = " - Sign Up";
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
	<title><?php echo NAME; ?><?php echo $title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<!--stylesheets-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
    </head>	
    <body>