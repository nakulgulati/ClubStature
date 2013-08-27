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
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<!--favicon-->	
	<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
    
	<!--stylesheets-->
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/bootstrap-glyphicons.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
	<link rel="stylesheet" type="text/css" href="css/customFonts.css">
	<link rel="stylesheet" type="text/css" href="css/typeahead.js-bootstrap.css">
	<link href='http://fonts.googleapis.com/css?family=Joti+One' rel='stylesheet' type='text/css'>
	<link href="assets/social-buttons/css/zocial.css" rel='stylesheet' type='text/css'>
		
	<!--Google Analytics-->
	<script>
	    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	  
	    ga('create', 'UA-43517157-1', 'clubstature.com');
	    ga('send', 'pageview');
      
	</script>
	    
    </head>	
    <body>