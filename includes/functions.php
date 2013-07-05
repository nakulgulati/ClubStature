<?php
// All functions go here

    function confirmQuery($resultSet){
        if(!$resultSet){
            die("Database query failed: " . mysql_error());
        }
    }
    
    	function redirect_to( $location = NULL ) {
		if ($location != NULL) {
			header("Location: {$location}");
			exit;
		}
	}

?>