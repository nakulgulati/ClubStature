<?php require_once("facebook/src/facebook.php"); ?>

<?php

    //Database Constants
    define("DB_SERVER","localhost");
    define("DB_USER","root");
    define("DB_PASS","");
    define("DB_NAME","clubstature");
    define("NAME","Club Stature");

    
    $config = array();
    $config['appId'] = '627888060569403';
    $config['secret'] = 'e6f8b314817a256f4b0bf0036f38c29b';
    $config['fileUpload'] = false; // optional
    
    $facebook = new Facebook($config);

?>