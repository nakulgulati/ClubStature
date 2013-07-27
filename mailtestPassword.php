<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php

function sendMail($userId,$status){

$userInfo = getUserInfo[$userId];

    if($status == "forgot"){  //if you forgot your password
        $body = "Hello {$userInfo['username']},
                \n  You've forgotten your password.  We've reset it for you.
                \n  That is all.   
                \n   -ClubStature";
        $subject = "Password Reset";

    }
    elseif($status == "change"){ //if you wanna change your password
        $body = "Hello {$userInfo['username']},
                \n Your password has been changed according to your arbitrary whims. 
                \n We would like to send you your new password, but unfortunately, we don't know it ourselves. 
                \n Good day! 
                \n \t    -ClubStature";
        $subject = "Password Change Successful"
    }

    elseif ($status == "create"){ //if you created an account
        $body = "Hello {$userInfo['username']},
                \n Thank you for creating an account with us!
                \n \t    -ClubStature";
        $subject = "Account creation ";
    }

    require_once "Mail.php";

    $useridentity = $_SESSION['userId'];     //no need
    $from     = "<darklord.mario666@gmail.com>";
    $toInfo = getUserInfo($useridentity); 
    $to = $toInfo['email']; 
    echo "Your email id is: " . $to;

    $subject  = "Password Change Successful";  //has to be changeable
    $body     = "Hello,\n Your password has been changed according to your arbitrary whims. \n
                We would like to send you your new password, but unfortunately, we don't know it ourselves. 
                \n Good day!";  //has to be changeable

    $host     = "ssl://smtp.gmail.com";
    $port     = "465";
    $username = "darklord.mario666@gmail.com";  //<> give errors
    $password = "darklordeshwar";

    $headers = array(
        'From'    => $from,
        'To'      => $to,
        'Subject' => $subject
    );
    $smtp = Mail::factory('smtp', array(
        'host'     => $host,
        'port'     => $port,
        'auth'     => true,
        'username' => $username,
        'password' => $password
    ));

    $mail = $smtp->send($to, $headers, $body);

    if (PEAR::isError($mail)) {
        echo("<p>" . $mail->getMessage() . "</p>");
    } 
	else {
        echo("<p>Message successfully sent!</p>");
    }
?>

}

<?php include("includes/footer.php"); ?>