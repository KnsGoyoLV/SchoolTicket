<?php 
session_start();
require_once("database/connectDB.php");
if(!isset($_SESSION['t'])){
    header('location: login.php');
   }
?>
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LVT TicketSupport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="style_main.css">

</head>

<body >

<header>
<nav class="navbar navbar-expand-lg bg-dark  navbar-dark py-3 fixed-top">
      <div class="container">
        <a href="#" class="animate-charcter" >Liepajas Valsts tehnikums</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navmenu"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navmenu">
          <ul class="navbar-nav ms-auto  ">
            <li class="nav-item">
              <a href="index.php" class="nav-link" style="background-color: #4782b5;"><i class="fas fa-home"></i>Sākumlapa</a>
            </li>
            <li class="nav-item">
              <a href="pievienot.php" class="nav-link"><i class="fas fa-plus"></i>Pievienot pieteikumu</a>
            </li>
            <li class="nav-item">
              <a href="info.php" class="nav-link"><i class="fas fa-circle-info"></i>Informācija</a>
            </li>

            <!-- Username and surname with drop down menu for login and admin panel  !-->
            <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center"
            href="#"
            id="navbarDropdownMenuLink"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
          <?= $_SESSION ['username'];?>  <?= $_SESSION['surname'];?>
          </a>
          <ul
            class="dropdown-menu dropdown-menu-end"
            aria-labelledby="navbarDropdownMenuLink"
          >
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
<div class="container bootstrap snippets bootdey">
    <div class="col-md-12">
        <div class="profile-container">
            <div class="profile-header row">
                <div class="col-md-4 col-sm-12 text-center">
                    <img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="header-avatar">
                </div>
                <div class="col-md-8 col-sm-12 profile-info">
                    <div class="header-fullname"><?= $_SESSION['username'];?> <?= $_SESSION['surname'];?></div>
                    <div class="header-information">
                    Statuss:<?= $_SESSION['job'];?>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 profile-stats">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12 stats-col">
                            <div class="stats-value pink">1</div>
                            <div class="stats-title">Mani pieteikumi</div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 stats-col">
                            <div class="stats-value"><?= $_SESSION['email'];?></div>
                            <div class="stats-title">E-pasts</div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 stats-col">
                            <div class="stats-value pink">kko vel ja vaig</div>
                            <div class="stats-title">kko vel ja vaig</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4 inlinestats-col">
                            <i class="glyphicon glyphicon-map-marker"></i> Liepajas Valsts tehnikums
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 inlinestats-col">
                            nezinu: <strong>1</strong>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 inlinestats-col">
                            nezinu: <strong>2</strong>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>
</div>


<div class="footer">
  <p> Liepajas Valsts tehnikums &copy; 2023</p>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  

<script src="files/script.js"></script>
</body>
</html>