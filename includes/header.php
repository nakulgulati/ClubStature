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

<?php require_once "Mail.php"; ?>


<!DOCTYPE html>
<html lang="en">
    <head>
	<title><?php echo NAME; ?><?php echo $title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    
	<!--stylesheets-->
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	    <link href="css/bootstrap-glyphicons.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
    </head>	
    <body>	
