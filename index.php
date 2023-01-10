<?php
use myPHPnotes\Microsoft\Auth;
use myPHPnotes\Microsoft\Handlers\Session;
use myPHPnotes\Microsoft\Models\User;
require "vendor/autoload.php";
  session_start();  
    if(!isset($_SESSION['token_id12']))
        echo "Error code:404";

  $client = new \Microsoft\Graph\Graph();
  $client->setAccessToken($_SESSION['token_id12']);
  
  $user = $client->createRequest('GET', '/me')
    ->setReturnType(Model\User::class)
    ->execute();
  
  echo $user->getGivenName();
?>