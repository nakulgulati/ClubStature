<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php
    $params = array(
        'redirect_uri' => 'http://localhost/public_html/Development/RateMyClub/postLogin.php'
    );

    $loginUrl = $facebook->getLoginUrl($params);

    redirect_to($loginUrl);
    
?>
