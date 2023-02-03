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
              <a href="#" class="nav-link" style="background-color: #4782b5;" ><i class="fas fa-plus"></i>Pievienot Pieteikumu</a>
            </li>
            <li class="nav-item">
              <a href="info.php" class="nav-link"><i class="fas fa-circle-info"></i>Informācija</a>
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

    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</header>
<body>

<form class="container-md" method="post">

<?php 
     // if submited then send query to database and add the new row to the table with the new info
        if(isset($_POST['submit1'])){
         $pdo->query("INSERT INTO `pieteikums`  ( `iela`, `telpa`, `status`, `problema`, `piezimes`, `risinajums_risinajums_id`, `epasts`) VALUES
                                                ('".$_POST['Iela']."', '".$_POST['Telpa']."', 'Neatrisināts', '".$_POST['Prob']."', '".$_POST['Piez']."', '1', '".$_SESSION['email']."')");
         header('location:index.php');
        }
        ?>


    <div class="INFO">
<p class="font-monospace">Ievadiet nepieciešamo Informāciju</p>
</div>
<div class="input-group mb-3">
<span class="input-group-text"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
<select class="form-select" id="Iela"name="Iela"required>
        <option selected>Izvēlēties ielu</option>
        <option value="Vānes iela">Vānes iela</option>
        <option value="Ventspils iela">Ventspils iela</option>
     </select>
     <span class="input-group-text"><div class="majina"><i class="fa fa-home" aria-hidden="true"></div></i></span>
     <input type="text" class="form-control" placeholder="Telpa" aria-label="Telpa">
</div>

<div class="input-group mb-3">
<span class="input-group-text"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
  <span class="input-group-text" id="basic-addon1">Problēma</span>
  <input type="text" class="form-control" placeholder="Problēma" required maxlength="95" aria-describedby="basic-addon1">
</div>

<div class="input-group">
<span class="input-group-text"><i class="fa fa-comments" aria-hidden="true"></i></span>
  <span class="input-group-text">Piezīme</span>
  <textarea class="form-control" placeholder="Piezīme" aria-label="With textarea"></textarea>
</div>

<div class="submit">
<button type="submit"name="submit1" value="Pievienot" class="btn btn-secondary btn-lg">Pievienot</button>
</div>
</form>


  <div class="footer">
  <p> Liepajas Valsts Tehnikums &copy; 2023</p>
</div>

</body>
</html>


<?php
// Problema - Pieteikums
// Izveleties ielu
?>