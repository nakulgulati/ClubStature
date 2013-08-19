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
        $output =   "<div class=\"container\">
                    <div class=\"navbar navbar-inverse navbar-fixed-top\">
                    <a href=\"index.php\"><img class=\"logo\" src=\"img/logo.png\"></a>    
                    <div class=\"container navContent\">
                    <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".nav-collapse\">
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                    </button>"; 
      
        if($public == true){
            $output .= "<div class=\"nav-collapse collapse\">
                        <ul class=\"nav navbar-nav main\">";
     
            $menuSet = getNavItems();
            
            while($menuItem = mysql_fetch_array($menuSet)){
                $output .= "<li><a href = \"{$menuItem['slug']}\">{$menuItem['menu_name']}</a></li>";
              }
              
            $output .= "</ul>"; //end of navbar content
            
            if(loggedIn()){
                //Display user welcome message
                $userDetails = getUserInfo($_SESSION['userId']);
                $output .= "<div class=\"btn-group pull-right\">
                            <p class=\"navbar-text greeting\" >Greetings,</p><p class=\"navbar-text user dopdown-toggle\" data-toggle=\"dropdown\"> {$userDetails['username']}</p>
                            <ul class=\"dropdown-menu\">
                            <li><a href=\"addClub.php\"><span class=\"glyphicon glyphicon-pencil\"></span> Add Club</a></li>
                            <li><a href=\"user.php?option=profile\"><span class=\"glyphicon glyphicon-user\"></span> Settings</a></li>
                            <li class=\"divider\"></li>
                            <li><a href=\"logout.php\"><span class=\"glyphicon glyphicon-off\"></span> Log Out</a></li>
                            </ul>
                            </div>";
            }
            else{
                $output .= "<div class=\"pull-right\">
                            <a class=\"btn btn-success navbar-btn\" href=\"login.php\">Login</a>
                            <a class=\"btn btn-info navbar-btn\" href=\"signup.php\">Sign Up</a>
                            </div>";
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
    
    function addUser($username,$college,$password,$email){
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
    
	if(strlen($password)<6){
	    array_push($errors,"Password should be minimum 6 characters.");
	}
        
        if(count($errors)==1){
            $query = "INSERT INTO `users`(`username`, `email`, `hashedPass`, `college`) VALUES ('{$username}','{$email}','{$password}','{$college}');";
	
            if(mysql_query($query,$connection)){
                $errors['status'] = 1;
                array_push($errors,"Sign Up successful. Login to continue.");
                
            }
	}
	return $errors;
    }
    
    
    function getUserInfo($userId){
        global $connection;
        
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
            
            $query="SELECT * FROM {$table} WHERE {$field1} = '{$value1}' and {$field2} = '{$value2}'";
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
				echo "Return Code: " . $_FILES["file"]["error"] . "<br>";//I think this is 4 when no file is submitted
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
        
        function printTopList($fieldname, $collfilter = ""){
            $query = "";
            if ($collfilter == ""){
                $query = "SELECT * FROM clubs ORDER BY {$fieldname} ASC LIMIT 10";
            }

            else{
                $query = "SELECT * FROM clubs WHERE college = '{$collfilter}' ORDER BY {$fieldname} ASC LIMIT 10";
            }
            global $connection;
            $output="";  
            $listSet = mysql_query($query,$connection);
            
            if($fieldname!="hits"){
                $output="<table class=\"table-striped\"
                        <tr><th>Club Name</th><th>Rating</th></tr>";
                while($listItem = mysql_fetch_array($listSet)){
                    $output.=   "<tr><td><a href=\"club.php?clubID={$listItem['id']}\">{$listItem['clubName']}</a></td><td>{$listItem[$fieldname]}</td></tr>";
                }
                $output.="</table>";
            }
            elseif($fieldname=="hits"){
                $output="<ol>";
                while($listItem = mysql_fetch_array($listSet)){
                    $output.="<li><a href=\"club.php?clubID={$listItem['id']}\">{$listItem['clubName']}</a></li>";
                }
                $output.="</ol>";
            }
            echo $output;
        }
        
        function hit($clubId){
            global $connection;
            $query="SELECT hits FROM clubs where id = {$clubId} LIMIT 1;";
            $resultSet = mysql_query($query,$connection);
            $result = mysql_fetch_array($resultSet);
            $hits = $result['hits'];
            $hits++;
            
            if(isset($_SERVER['HTTP_REFERER'])){
                $query="UPDATE `clubs` SET `hits`={$hits} WHERE `id` = {$clubId}";
                mysql_query($query,$connection);  
            }
        }
        
        function sendMail($userId, $status, $bodyContent = ""){
        require_once("Mail.php");
        
        $host     = "ssl://smtp.gmail.com";
        $port     = "465";
        $username = "clubstature@gmail.com";  //<> give errors
        $password = "pokemonshowdown";

        $from     = "<clubstature@gmail.com>";

        //echo $userId;

        $userInfo = getUserInfo($userId);

        $to = "<" . $userInfo['email'] . ">";

        $body = "";
        $body = file_get_contents('./emailUpperHalf.html');
        if($status == "forgot"){  //if you forgot your password
            
            $body .= "Hello {$userInfo['username']},
                    \n  You've forgotten your password.  We've reset it for you. It is now {$bodyContent}.
                    \n  That is all.   
                    \n   -ClubStature";

            $subject = "Password Reset";
        }
        elseif($status == "change"){ //if you wanna change your password
          

            $body .= "Hello {$userInfo['username']},
                \n Your password has successfully been changed according to your arbitrary whims. 
                \n Your password has been changed according to your arbitrary whims. 
                \n We would like to send you your new password, but unfortunately, we don't know it ourselves. 
                \n Good day! 
                \n \t    -ClubStature";

            $subject = "Password Change Successful";
        }
        elseif ($status == "create"){ //if you created an account
   
            $body .= "Hello {$userInfo['username']},
            \n Thank you for creating an account with us!
            \n \n \t    -ClubStature";

            $subject = "Account creation ";
        }

        $body .= file_get_contents('./emailLowerHalf.html');

        $headers = array(
        'MIME-Version' => '1.0',
        'Content-Type' => "text/html; charset=ISO-8859-1",
        'From'    => $from,
        'To'      => $to,
        'Subject' => $subject
        //$headers .= "MIME-Version: 1.0\r\n";
        //Content-Type => text/html; charset=ISO-8859-1\r\n;
        );
        $smtp = Mail::factory('smtp', 
         array(
        'host'     => $host,
        'port'     => $port,
        'auth'     => true,
        'username' => $username,
        'password' => $password
        ));

        $mail = $smtp->send($to, $headers, $body);
    }
      
    function uploadFile($fileName,$clubName){
	
	global $connection;
	
	$allowedExts = array("gif", "jpeg", "jpg", "png", "PNG", "JPEG", "GIF", "JPG");
	$temp = explode(".", $fileName);
	$extension = end($temp);
	
	$query = "SELECT COUNT(id) AS total FROM clubs";
	$resultSet = mysql_query($query,$connection);
	$row = mysql_fetch_array($resultSet);
	$id = $row['total'];
	$id++;
	
	$newName = $id."-".str_replace(" ","",$clubName);
	
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
			move_uploaded_file($_FILES["file"]["tmp_name"], "img/clubImages/".$newName);
			return $newName;
    		}
	}
    }
    
    function updateInfo($username,$newName,$newEmail,$newCollege){
	global $connection;
	
	$userDetails = getData("users","*","username",$username);
	$user = mysql_fetch_array($userDetails);
	
	
	if($user['name']==$newName && $user['email']==$newEmail && $user['college']==$newCollege){
	    return 0;
	}
	else{
	    $query = "UPDATE users SET ";
	    
	    if(($user['name']!=$newName) && ($user['email']==$newEmail) && ($user['college']==$newCollege)){
		$query.="name = '{$newName}' ";
	    }
	    elseif($user['name']!=$newName){
		$query.="name = '{$newName}', ";
	    }
	    
	    if(($user['email']!=$newEmail) && ($user['college']!=$newCollege)){
		$query.="email = '{$newEmail}', ";
	    }
	    elseif($user['email']!=$newEmail){
		$query.="email = '{$newEmail}' ";	    
	    }
	    
	    if($user['college']!=$newCollege){
		$query.="college = '{$newCollege}' ";
	    }
	
	    $query.="WHERE username = '{$username}'";
	    
	    if(mysql_query($query,$connection)){
		return 1;
	    }
	    else{
		return 0;
	    }
	}
    }
    
    function changePassword($username,$oldPass,$newPass,$verifyNewPass){
	global $connection;
	$errors = array("status" => 0);
	
	$userDetails = getData("users","*","username",$username);
	$user = mysql_fetch_array($userDetails);
	
	if(sha1($oldPass)!=$user['hashedPass']){
	    array_push($errors,"Old password incorrect.");
            return $errors;
	}
	
	if(strlen($newPass)>=6){
	    if($newPass != $verifyNewPass){
	        array_push($errors,"Passwords don't match.");
	    }
	}
	else{
	    array_push($errors,"Password should be minimum 6 characters.");
	}
	
	if($oldPass==$newPass){
	    array_push($errors,"Old password and new password cannot be same.");
            return $errors;
	}
	$newPass = sha1($newPass);
	if(count($errors)==1){
            $query = "UPDATE users SET hashedPass = '{$newPass}' WHERE username = '{$username}'";
	
            if(mysql_query($query,$connection)){
                $errors['status'] = 1;
                array_push($errors,"Password changes successfully");
                
            }
	}
	return $errors;
	
    }
    
    function printUserNav($selectedOpt){
	$output = "<ul class=\"nav nav-pills nav-stacked userNavPills\">";
	
	$resultSet = getData("userNav","*","heading","1");
	$output.="<legend>Information</legend>";
	
	while($row = mysql_fetch_array($resultSet)){
	    $output.="<li";
	    if($row['option']==$selectedOpt){
		$output.=" class=\"active\" ";
	    }
	    
	    $output.="><a href=\"user.php?option={$row['option']}\">{$row['menu']}</a></li>";   
	}
	
	$resultSet = getData("userNav","*","heading","2");
	$output.="<legend>Change Account Settings</legend>";
	
	while($row = mysql_fetch_array($resultSet)){
	    $output.="<li";
	    if($row['option']==$selectedOpt){
		$output.=" class=\"active\" ";
	    }
	    
	    $output.="><a href=\"user.php?option={$row['option']}\">{$row['menu']}</a></li>";   
	}
        
        $resultSet = getData("userNav","*","heading","3");
        $output.="<legend>Club Settings</legend>";
        while($row = mysql_fetch_array($resultSet)){
	    $output.="<li";
	    if($row['option']==$selectedOpt){
		$output.=" class=\"active\" ";
	    }
	    
	    $output.="><a href=\"user.php?option={$row['option']}\">{$row['menu']}</a></li>";   
	}
            
        $resultSet = getData("userNav","*","heading","4");
	$output.="<legend>Log Out</legend>";
	
	while($row = mysql_fetch_array($resultSet)){
	    $output.="<li";
	    if($row['option']==$selectedOpt){
		$output.=" class=\"active\" ";
	    }
	    
	    $output.="><a href=\"logout.php\">{$row['menu']}</a></li>";   
	}
	
	$output.="</ul>";
	echo $output;
    }
    
    function updateNewPassword($resetCode,$newPass,$verifyNewPass){
        global $connection;
        $errors = array();
        $userDetails = getData("users","*","resetCode",$resetCode);
        $user = mysql_fetch_array($userDetails);
        
        //password processing
        if(strlen($newPass)>=6){
	    if($newPass != $verifyNewPass){
	        array_push($errors,"Passwords don't match.");
                return $errors;
	    }
	}
	else{
	    array_push($errors,"Password should be minimum 6 characters.");
            return $errors;
	}
        
        $newPass = sha1($newPass);
        
        $query="UPDATE users SET hashedPass = '{$newPass}', resetCode = -1 WHERE resetCode = {$resetCode}";
        
        if(mysql_query($query,$connection)){
            array_push($errors,"Password reset successful.");
            return $errors;
        }
    }
    
    function generateNewPassword($email){
        global $connection;
        
        $resultSet = getData("users","*","email",$email);
        if(mysql_num_rows($resultSet)==1){
            $row = mysql_fetch_array($resultSet);
            
            $randNo = rand(100,10000);
            
            $query="UPDATE  `users` SET  `resetCode`={$randNo} WHERE  `email` =  '{$email}' ";
            mysql_query($query,$connection);
            
            return $randNo;
        }
        else{
            return -1;
        }
    }
    
    function logout($returnTo = ""){
        session_start(); //Finding session start
    
        // 2. Unset all the session variables
        $_SESSION = array(); // Reset all the session variables
        
        if(isset($_COOKIE[session_name()])) {
            //Destroy the session cookie
                setcookie(session_name(), '', time()-42000, '/');
        }
    
        session_destroy(); //Destroy the session
        
        if($returnTo !=""){
            redirect_to("{$returnTo}");        
        }
        
    }
    
    function deleteAccount($username,$pass){
	global $connection;
	$userDetails = getData("users","*","username",$username);
	$user = mysql_fetch_array($userDetails);
	
	$errors = array();
	
	if(sha1($pass) == $user['hashedPass']){
	    $query="DELETE FROM users WHERE username='{$username}'";
	    
	    if(mysql_query($query, $connection)){
		$errors['status'] = 1;
		return $errors;
	    }
	}
	else{
	    $errors['status'] = 0;
	    return $errors;
	}
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
	    $query = "UPDATE clubs SET clubName = '{$newClubName}', category = '{$newCategory}', url = '{$newUrl}', description = '{$newDesc}' WHERE creator = '{$creator}' && clubName = '{$clubName}'";
	    mysql_query($query,$connection);
	}
	return $updates;
    }
    
    function deleteClub($clubName,$creator,$pass){
	global $connection;
	$status = 0;
	$userDetails = getData("users","*","username",$_SESSION['username']);
	$user = mysql_fetch_array($userDetails);
	
	if(sha1($pass) == $user['hashedPass'] ){
	    $query="DELETE FROM clubs WHERE creator='{$creator}' && clubName='{$clubName}'";
	    mysql_query($query,$connection);
	    $status = -1;
	}
	else{
	    $status = -2;
	}
	return $status;
	
    }
    
    function transferClub($clubName,$creator,$newCreator,$pass){
	global $connection;
	$status = 0;
	$userDetails = getData("users","*","username",$_SESSION['username']);
	$user = mysql_fetch_array($userDetails);
	
	if(sha1($pass) == $user['hashedPass'] ){
	    $query="UPDATE clubs SET creator = '{$newCreator}' WHERE creator='{$creator}' && clubName='{$clubName}'";
	    mysql_query($query,$connection);
	    $status = 2;
	}
	else{
	    $status = -2;
	}
	return $status;
    }
    
?>
