<?php
require_once("database/connectDB.php");
require "vendor/autoload.php";

$env = parse_ini_file('database/.env');
session_start();

$tenant = $env['tenant'];
$client_id = $env['client_id'];
$client_secret = $env['client_secret'];
$callback = $env['callback'];

if (array_key_exists('access_token', $_POST)) {
  //save access_token to SESSION t variable
  $_SESSION['t'] = $_POST['access_token'];
  $t = $_SESSION['t'];
  $ch = curl_init();
  //get users json data from /me/ endpoint
  curl_setopt(
    $ch,
    CURLOPT_HTTPHEADER,
    array(
      'Authorization: Bearer ' . $t,
      'Conent-type: application/json'
    )
  );
  curl_setopt($ch, CURLOPT_URL, "https://graph.microsoft.com/v1.0/me/");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $rez = json_decode(curl_exec($ch), 1);
  if (array_key_exists('error', $rez)) {
    //if we have a error dump everything that error gives us  
    var_dump($rez['error']);
    die();
  } else { // get users data from json with $rez variable name
    $_SESSION['username'] = $rez["givenName"];
    $_SESSION['surname'] = $rez["surname"];
    $_SESSION['email'] = $rez['mail'];
    $_SESSION['id'] = $rez["id"];
    $_SESSION['job'] = $rez["jobTitle"];
  }
  curl_close($ch);
  header('Location: ' . $callback);
}
// if acces token is invalid or not gotten then go back to login.php file
if (!isset($_SESSION['t'])) {
  header('location:login.php');
}

//Block subdomain 
$parts = explode('@', $_SESSION['email']);
$domain = array_pop($parts);
$blocked_domains = array('sk'); // to block sub domain add sk in here

if (!$_SESSION['username'] == 'Daniels' && in_array(explode('.', $domain)[0], $blocked_domains)) {
  header("Location:blocked.php");
  exit();
}

// $result = $pdo->query("SELECT epasts,loma FROM lietotajs WHERE epasts = '".$_SESSION['email']."'");
// if($result->rowCount() > 0){
//     // if microsoft email is found in our Database get his user type
//     //Selects user type and sets it to session
//     while ($row = $result->fetch()) {
//         $_SESSION['type'] = $row['loma'];
//     }
// }
// else{
//     // if not found in our Database then ask what his user type is 
//     header("Location:privlages.php");
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="lv">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LVT TicketSupport</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <link rel="stylesheet" href="style_main.css">

</head>

<body>

  <header>
    <nav class="navbar navbar-expand-lg bg-dark  navbar-dark py-3 fixed-top">
      <div class="container">
        <a href="#" class="animate-charcter">Liepājas Valsts tehnikums</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navmenu">
          <ul class="navbar-nav ms-auto  ">
            <li class="nav-item">
              <a href="index.php" class="nav-link" style="background-color: #4782b5;"><i
                  class="fas fa-home"></i>Sākumlapa</a>
            </li>
            <li class="nav-item">
              <a href="pievienot.php" class="nav-link"><i class="fas fa-plus"></i>Pievienot pieteikumu</a>
            </li>
            <li class="nav-item">
              <a href="info.php" class="nav-link"><i class="fas fa-circle-info"></i>Informācija</a>
            </li>

            <!-- Username and surname with drop down menu for login and admin panel  !-->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
                id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $_SESSION['username']; ?> <?= $_SESSION['surname']; ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                <li>
                  <a class="dropdown-item" href="functions/IsAdmin.php">Admin panelis</a>
                </li>
                <li>
                  <a class="dropdown-item" href="../logout.php">Izrakstīties</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
  </header>