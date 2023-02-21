<?php
 require_once("database/connectDB.php");
 require "vendor/autoload.php";
session_start();  

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="pievienot.css">

</head>

<body >

<header style="
    padding-bottom: 6px;">
<nav class="navbar navbar-expand-lg bg-dark  navbar-dark py-3 fixed-top" style="bottom: 914px;">
      <div class="container">
        <a href="index.php" class="animate-charcter">Liepajas Valsts tehnikums</a>
        
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
              <a href="#" class="nav-link" style="background-color: #4782b5;" ><i class="fas fa-plus"></i>Pievienot Pieteikumu</a>
            </li>
            <li class="nav-item">
              <a href="info.php" class="nav-link"><i class="fas fa-circle-info"></i>Informācija</a>
            </li>
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
<body>

<form class="container-md" method="post">

<?php 
     // if submited then send query to database and add the new row to the table with the new info
        if(isset($_POST['submit1'])){
         $pdo->query("INSERT INTO `pieteikums`  ( `iela`, `telpa`, `status`, `problema`, `piezimes`, `nodala`, `epasts`,`vards`,`uzvards`) VALUES
                                                ('".$_POST['Iela']."', '".$_POST['Telpa']."', 'Neatrisināts', '".$_POST['Prob']."', '".$_POST['Piez']."', '".$_POST['nodala']."', '".$_SESSION['email']."', '". $_SESSION['username']."', '". $_SESSION['surname']."')");
         header('location:index.php');
        }
        ?>


    <div class="INFO">
<p class="font- 'Nunito', sans-serif;">Ievadiet nepieciešamo informāciju</p>
</div>
<div class="input-group mb-3">
<span class="input-group-text"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
<select class="form-select" id="Iela"name="Iela" required>
    <div></div>
        <option>Izvēlēties ielu</option>
        <option value="Vānes iela">Vānes iela</option>
        <option value="Ventspils iela">Ventspils iela</option>
     </select>
     <span class="input-group-text"><i class="fa fa-home" aria-hidden="true"></i></span>
     <input type="text" class="form-control" placeholder="Telpa" aria-label="Telpa" oninvalid="this.setCustomValidity('Lūdzu aizpildiet šo lauku')" name="Telpa" maxlength="5" required>
     <br>
     <select class="form-select" id="nodala"name="nodala" required>
    <div></div>
        <option>Izvēlēties nodaļu</option>
        <option value="IT">IT nodaļa</option>
        <option value="Saimniecības">Saimniecības nodaļa</option>
     </select>
</div>

<div class="input-group mb-3">
<span class="input-group-text"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
  <span class="input-group-text" id="basic-addon1">Problēma</span>
  <!-- After getting the error it dosent let you submit the ticket  !-->
  <input type="text" class="form-control" name="Prob" placeholder="Problēma" oninvalid="this.setCustomValidity('Lūdzu aizpildiet šo lauku')"  maxlength="95" aria-describedby="basic-addon1" required>
</div>

<div class="input-group">
<span class="input-group-text"><i class="fa fa-comments" aria-hidden="true"></i></span>
  <span class="input-group-text">Piezīme</span>
  <textarea class="form-control"name="Piez" placeholder="Piezīme"  maxlength="95" aria-label="With textarea"></textarea>
</div>

<div class="submit">
<button onclick="window.location.href='index.php'" href="index.php" class="btn btn-secondary btn-lg" style="background-color: red;">Atcelt</button>
<button type="submit"name="submit1" value="Pievienot" class="btn btn-secondary btn-lg" style="background-color: limegreen;">Pievienot</button>
</div>
</form>

<?php
require "footer.php";
?>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
</body>
</html>

