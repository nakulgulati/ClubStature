<?php require_once("includes/sessions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php
    setReturnPath(session_id(),$_SERVER['HTTP_REFERER']);
    $params = array(
        'redirect_uri' => 'http://clubstature.com/postLogin.php'
    );

    $loginUrl = $facebook->getLoginUrl($params);

    redirect_to($loginUrl);
    
?>
