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
    <link rel="stylesheet" href="style_main.css">

</head>

<body >

<header>
<nav class="navbar navbar-expand-lg bg-dark  navbar-dark py-3 fixed-top">
      <div class="container">
        <a href="#" class="navbar-brand">Liepajas Valsts Tehnikums</a>
        

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
              <a href="login.php" class="nav-link"><i class="fas fa-home"></i>Sākum Lapa</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link" ><i class="fas fa-plus"></i>Pievienot Problēmas</a>
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
        if(isset($_POST['submit1'])){
         $pdo->query("INSERT INTO `pieteikums`  ( `iela`, `telpa`, `status`, `problema`, `piezimes`, `risinajums_risinajums_id`, `epasts`) VALUES
                                                ('".$_POST['Iela']."', '".$_POST['Telpa']."', 'Neatrisināts', '".$_POST['Prob']."', '".$_POST['Piez']."', '1', '".$_SESSION['email']."')");
         header('location:index.php');
        }
     ?>
     <h3 align="center">Lūdzu ievadiet informāciju</h3>  
     <div class="form-group row ">
     <select class="form-select" id="Iela"name="Iela">
        <option selected>Lūdzu izvēlējaties ielu</option>
        <option value="Vānes iela">Vānes iela</option>
        <option value="Ventspils iela">Ventspils iela</option>
     </select>

     <div class="col">
        <input class="telpa" type="text" placeholder="Telpa" name="Telpa" />
    </div>
    </div>
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"  name="Prob"></textarea>
            <label for="floatingTextarea">Problēma</label>
       
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"  name="Piez"></textarea>
            <label for="floatingTextarea">Piezīme</label>
      
	    <input class="pievienot" type= "submit" name="submit1" value="Pievienot"/>
   
	</form>

  <div class="footer">
  <p> Liepajas Valsts Tehnikums &copy; 2023</p>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 

</body>
</html>