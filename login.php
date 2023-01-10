<?php
use myPHPnotes\Microsoft\Auth;
require "vendor/autoload.php";

session_start();
$env = parse_ini_file('ID.env');

$tenant =$env['tenant'];
$client_id = $env['client_id'];
$client_secret = $env['client_secret'];
$callback = $env['callback'];
$scopes = ["https://graph.microsoft.com/.default"];

if (!isset($_SESSION['access_token'])) {
    $microsoft = new Auth($tenant, $client_id, $client_secret,$callback, $scopes);
    header("location: " . $microsoft->getAuthUrl());
    //TODO: Find how the token is stored in microsoft graph
    $_SESSION['token_id12'] = $_SESSION['access_token'];
    exit;
}
?>