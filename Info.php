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
        <a href="#" class="animate-charcter">Liepajas Valsts tehnikums</a>
        

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
              <a href="login.php" class="nav-link"><i class="fas fa-home"></i>Sākumlapa</a>
            </li>
            <li class="nav-item">
              <a href="pievienot.php" class="nav-link" ><i class="fas fa-plus"></i>Pievienot Problēmas</a>
            </li>
            <li class="nav-item">
              <a href="info.php" class="nav-link"style="background-color: #4782b5;"><i class="fas fa-circle-info"></i>Informācija</a>
            </li>
            <li class="nav-item">
                <a hred="logout.php"><?php 		
                echo " <a href='logout.php' style='font-family: ui-sans-serif;'>" .$_SESSION['username']." ".$_SESSION['surname']. "<i class='fas fa-power-off'></i></a>";     
                ?>
            </nav>
            </li>    
          </ul>
        </div>
      </div>
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
                    Status:<?= $_SESSION['job'];?>
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
  <p> Liepajas Valsts Tehnikums &copy; 2023</p>
</div>

<script src="files/script.js"></script>
</body>
</html>