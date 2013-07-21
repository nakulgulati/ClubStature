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
                        </div>"; //end of navbar content
            
            if(loggedIn()){
                //Display user welcome message
                $userDetails = getUserInfo($_SESSION['userId']);
                $output .= "<div class=\"btn-group pull-right\">
                            <h3 class=\"user dopdown-toggle\" data-toggle=\"dropdown\">{$userDetails['username']}</h3>
                            <ul class=\"dropdown-menu\">
							<li><a href=\"passchange.php\">Change Password</a></li>
                            <li><a href=\"logout.php\">Log Out</a></li>
                            </ul>
                            </div>"; //end of btn group
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
    
    function getClubList(){
        global $connection;
        
        $query = "SELECT * FROM `clubs`";
        $clubSet = mysql_query($query,$connection);
        
        confirmQuery($clubSet);
        
        while($clubList = mysql_fetch_array($clubSet)){
            echo "<a href=\"club.php?clubID={$clubList['id']}\">".$clubList['clubName']."</a><br>";
        }
    }
    
    function getClubInfo($clubID){
        global $connection;
        
        $query = "SELECT * FROM  `clubs` WHERE  `id` =  '{$clubID}' LIMIT 1;";
        $clubSet = mysql_query($query,$connection);
        
        if($clubSet){
            return $clubDetails = mysql_fetch_array($clubSet);
        }
    }
    
    function getComments($clubID){
        global $connection;
        
        $query = "SELECT * FROM `comments` WHERE `clubID` = '{$clubID}';";
        $commentSet = mysql_query($query,$connection);
        
        confirmQuery($commentSet);
        while($comment = mysql_fetch_array($commentSet)){
            $output="<div class=\"review\">
                    <b class=\"pull-right\">{$comment['username']}</b><br>
                    <p><small class=\"pull-right\">-{$comment['timeStamp']}</small></p><br>
                    <p>
                    {$comment['comment']}                   
                    </p>
                    <hr>
                    </div>";
            echo $output;
        }
    }
    
    function getData($tableName,$fieldName = "*",$conditionField = NULL,$conditionValue = NULL){
      //doesnt work for searching by ID
      //returns resultset
      global $connection;
      
      if(($conditionValue!=NULL)&&($conditionField!=NULL)){
        $query = "SELECT {$fieldName} FROM {$tableName} WHERE {$conditionField} = '{$conditionValue}';";
      }
      else{
        $query = "SELECT {$fieldName} FROM {$tableName};";
      }
      $resultSet = mysql_query($query,$connection);
      confirmQuery($resultSet);
      
      return $resultSet;
   }
   
   function calculateRating($clubId,$userId,$username,$rigor,$cohesiveness,$scheduleFriendliness){
        global $connection;
        $query="INSERT INTO `rating`(`clubId`, `userId`, `username`, `rigor`, `cohesiveness`, `scheduleFriendliness`) VALUES ({$clubId},{$userId},'{$username}',{$rigor},{$cohesiveness},{$scheduleFriendliness});";
        if(mysql_query($query,$connection))
        {
            $query="SELECT AVG(rigor) AS ravg FROM rating WHERE clubId={$clubId}";
            $resultSet = mysql_query($query,$connection);
            $rAvg=mysql_fetch_array($resultSet);
            $rigor=$rAvg['ravg'];
            
            $query="SELECT AVG(cohesiveness) AS cavg FROM rating WHERE clubId={$clubId}";
            $resultSet = mysql_query($query,$connection);
            $cAvg=mysql_fetch_array($resultSet);
            $cohesiveness=$cAvg['cavg'];
            
            $query="SELECT AVG(scheduleFriendliness) AS sFavg FROM rating WHERE clubId={$clubId}";
            $resultSet = mysql_query($query,$connection);
            $sFAvg=mysql_fetch_array($resultSet);
            $scheduleFriendliness=$sFAvg['sFavg'];
            
            $or=($rigor*4+$scheduleFriendliness*2+$cohesiveness*4)/10;
            
            $query="UPDATE clubs SET `overallRating`={$or},`rigor`={$rigor},`cohesiveness`={$cohesiveness},`scheduleFriendliness`={$scheduleFriendliness} WHERE id={$clubId};";
            mysql_query($query,$connection);
        }
    }    
?>
