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
        
        $query = "SELECT * FROM menu ORDER BY position;";
        $menu_set = mysql_query($query, $connection);
        confirmQuery($menu_set);
        return $menu_set;
    }
    
    function printNav($public = true){
        $output = "";
        $output .= "<div class=\"navbar navbar-inverse navbar-fixed-top\">
                    <div class=\"navbar-inner\">
                    <div class=\"container\">
                    <a class=\"brand\" href=\"index.php\">";
        $output .= NAME;            
        $output .= "</a>";
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
                            <li><a href=\"changePassword.php\">Change Password</a></li>
                            <li><a href=\"deleteAccount.php\"><i class=\"icon-trash\"></i> Delete Account </a></li>
                            <li class=\"divider\"></li>
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
    
    function addUser($username,$password,$verifyPassword,$email){
	global $connection;
        $errors = array("status" => 0);
        if(!isUnique("users","username",$username)){
            array_push($errors,"Username already taken.");
            return $errors;
        }
        
        if(!isUnique("users","email",$email)){
            array_push($errors,"An account already exists for this email.");
            return $errors;
        }
        
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
        
        if(count($errors)==1){
            $query = "INSERT INTO `users`(`username`, `email`, `hashedPass`) VALUES ('{$username}','{$email}','{$password}');";
	
            if(mysql_query($query,$connection)){
                $errors['status'] = 1;
                array_push($errors,"Sign Up successful. Login to continue.");
                
            }
	}
	return $errors;
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
            $output="<tr><td><div class=\"review\">
                    <b class=\"pull-right\">{$comment['username']}</b><br>
                    <p><small class=\"pull-right\">-{$comment['timeStamp']}</small></p><br>
                    <p>
                    {$comment['comment']}                   
                    </p>
                    </div></td></tr>";
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
   
   function calculateRating($clubId,$clubName,$userId,$username,$rigor,$cohesiveness,$scheduleFriendliness){
        global $connection;
        $status = 0;
        
        if(!isCombinationUnique("rating","clubId","username",$clubId,$username)){
            $status = 0;
            return $status;
        }
        
        $query="INSERT INTO `rating`(`clubId`, `clubName`, `userId`, `username`, `rigor`, `cohesiveness`, `scheduleFriendliness`) VALUES ({$clubId},'{$clubName}',{$userId},'{$username}',{$rigor},{$cohesiveness},{$scheduleFriendliness});";
        if(mysql_query($query,$connection)){
            
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
            if(mysql_query($query,$connection)){
                return $status = 1;
            }
        }
    }
    
    function isUnique($tableName,$field,$value){
        
        global $connection;

        $query="SELECT * FROM {$tableName} WHERE {$field} = '{$value}'";
        $result=mysql_query($query,$connection);
        $var= mysql_num_rows($result);
        
        if($var>=1){
            return false;
        }
        else{
            return true;
        }
    }
    
    function isCombinationUnique($table,$field1,$field2,$value1,$value2){
            global $connection;
            
            $query="SELECT * FROM {$table} WHERE {$field1} = {$value1} and {$field2} = '{$value2}'";
            $result=mysql_query($query,$connection);
            $var= mysql_num_rows($result);
            
            if($var>=1){
                return false;
            }
            else{
                return true;
            }
    }
    
    function storeIcon(){
		$allowedExts = array("gif", "jpeg", "jpg", "png", "PNG", "JPEG", "GIF", "JPG");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);  

		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& ($_FILES["file"]["size"] < 1000000) //file size less than 1000 kB or 1 MB
		&& in_array($extension, $allowedExts)) {
			if($_FILES["file"]["error"] > 0){
				echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
			}
			else {
				echo "Upload: " . $_FILES["file"]["name"] . "<br>";
				echo "Type: " . $_FILES["file"]["type"] . "<br>";
				echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
				echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

				if (file_exists("images/" . $_FILES["file"]["name"])){
					echo $_FILES["file"]["name"] . " already exists. ";
				}
				else{
					move_uploaded_file($_FILES["file"]["tmp_name"], "images/".$_FILES["file"]["name"]);
					echo "Stored in: " . "images/" . $_FILES["file"]["name"];
					}
			}
		}
		else{
		echo "Invalid file";
		}
	}
?>
