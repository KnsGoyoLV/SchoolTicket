<?php 
    require_once("database/connectDB.php");
    require "vendor/autoload.php";
    $env = parse_ini_file('database/.env');  
    $url = 'https://login.microsoftonline.com/'.$env['tenant'].'/oauth2/logout?post_logout_redirect_uri='.$env['logout'].'';
    header('Location: ' . $url);
?>

