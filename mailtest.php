<?php
    require_once "Mail.php";

    $from     = "<darklord.mario666@gmail.com>";
    $to       = "<amitkalay@yahoo.com>";
    $subject  = "Hi!";
    $body     = "<b>Hi,\n\nHow are you?</b>";

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