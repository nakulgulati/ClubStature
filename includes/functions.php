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
    
    function getNavItems() {
        global $connection;
        
        $query = "SELECT * FROM menu;";
        $menu_set = mysql_query($query, $connection);
        confirmQuery($menu_set);
        return $menu_set;
    }
    
    function printNav($public = true){
        $output = "";
        $output .= "<div class=\"navbar navbar-inverse navbar-fixed-top\">
                    <div class=\"navbar-inner\">
                    <div class=\"container\">
                    <a class=\"brand\" href=\"index.php\">Rate My Club</a>";
        if($public == true){
            $output .= "<div class=\"navbar-content\">
                                <ul class=\"nav\">";
     
            $menuSet = getNavItems();
            
            while($menuItem = mysql_fetch_array($menuSet)){
                $output .= "<li><a href = \"{$menuItem['slug']}\">{$menuItem['menu_name']}</a></li>";
              }
              
            $output .= "</ul>
                        </div>";
            
            if(loggedIn()){
                //Display user welcome message
                $userDetails = getUserInfo($_SESSION['userId']);
                $output .= "<div class = \"pull-right\">
                            <p>{$userDetails['username']}</p>
                            <a href = \"logout.php\" class = \"btn btn-warning\">Log Out</a>
                            <div>";
            }
            else{
                $output .= "<div class = \"pull-right\">
                            <a href = \"login.php\" class = \"btn btn-success\">Login</a>
                            <a href = \"signup.php\" class = \"btn btn-info\">Sign Up</a>
                            <div>";
            }            
            $output .= "</div>
                        </div>
                        </div>
                        </div>";
        }
        else{
            $output .= "</div>
                        </div>
                        </div>";
                        
        }
        return $output;
        
    }
    
    function signUpValidation($username,$password,$verifyPassword){
	$errors = array();
	if(!ctype_alnum($username)){
	    array_push($errors,"Username cannot contain special characters.");
	}
    
	if(strlen($password)>6){
	    if($password != $verifyPassword){
	        array_push($errors,"Passwords don't match.");
	    }
	}
	else{
	    array_push($errors,"Password should be minimum 6 characters.");
	}
	return $errors;
    }
    
    function addUser($errors){
        global $username;
        global $email;
        global $password;
        global $verifyPassword;
        global $connection;
        
	if(count($errors)==0){
	$query = "INSERT INTO `users`(`username`, `email`, `hashedPass`) VALUES ('{$username}','{$email}','{$password}');";
	
	    if(mysql_query($query,$connection)){
	        $message = "Sign Up success.";
	    }
	    else{
	        $message = "Sign Up failed.";
	    }
	}
        return $message;
    }
    
    function getUserInfo($userId){
        global $connection;
        
        $userId = $_SESSION['userId'];
        $query = "SELECT * FROM  `users` WHERE  `id` =  '{$userId}' LIMIT 1;";
        $userSet = mysql_query($query,$connection);
        
        if($userSet){
            return $userDetails = mysql_fetch_array($userSet);
        }
    }
    
?>
