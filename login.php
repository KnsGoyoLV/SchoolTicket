<?php
session_start();
require "vendor/autoload.php";
use myPHPnotes\Microsoft\Auth;
$tenant = "091c9fa6-7934-4f1c-b232-ddeea4726d3b";
$client_id = "a5520baf-956d-48c1-9d59-1697891ecfb1";
$client_secret = "7908a999-72b2-4e5f-b8fa-7c528c429dae";
$callback = "http://localhost";
$scopes = ["https://graph.microsoft.com/.default"];
$microsoft = new Auth($tenant, $client_id, $client_secret,$callback, $scopes);
header("location: " . $microsoft->getAuthUrl());
?>