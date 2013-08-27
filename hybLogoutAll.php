<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	
    // config and whatnot
    $config   = dirname(__FILE__) . '/hybridauth/config.php';
    require_once( "hybridauth/Hybrid/Auth.php" );

    try{
	$hybridauth = new Hybrid_Auth( $config );

	// logout the user from $provider
	$hybridauth->logoutAllProviders(); 

	// return to login page
	//$hybridauth->redirect( "index.php" );
	deleteReturnPath(session_id());
	logout($_SERVER['HTTP_REFERER']);
		
		
    }
    catch( Exception $e ){
	echo "<br /><br /><b>Oh well, we got an error :</b> " . $e->getMessage();

	echo "<hr /><h3>Trace</h3> <pre>" . $e->getTraceAsString() . "</pre>"; 
    }
