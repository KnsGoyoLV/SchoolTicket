<?php
 require_once("connectDB.php");
 require "vendor/autoload.php";
session_start();  
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
    <a href="#" class="animate-charcter">Liepajas Valsts Tehnikums</a>
    <nav class="navbar">
        <a href="index.php"><i class="fas fa-home"></i>Sākumlapa</a>
        <a href="#NewInfo" class="active"><i class="fas fa-plus"></i>Pievienot atbalsta biļeti</a>
        <a href="#info.php"><i class="fas fa-circle-info"></i>Jaunumi</a>
    </nav>
    <nav class="navbar">
    <a hred="login.php"><b><?php 		
       //  echo " <a href='login.php'><b>" . $_SESSION['username'] . "</b> <i class='fas fa-power-off'></i></a>";
     ?> </b>
    
    </nav>
    <nav class="navbar">
    <a hred="login.php"><?php 		
         echo " <a href='startpage'><b style='font-family: ui-sans-serif;'>" .$_SESSION['username']." ".$_SESSION['surname']. "</b> <i class='fas fa-power-off'></i></a>";
     ?> 
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</header>
   


    <form class="add_info" method="post">
     <?php 
        if(isset($_POST['submit1'])){
         $result = $pdo->query("SELECT * FROM pieteikums");
         $id = $result->rowCount() + 1;
         $pdo->query("INSERT INTO `pieteikums` (`ticket_id`, `laiks`, `iela`, `telpa`, `status`, `problema`, `piezimes`, `risinajums_risinajums_id`, `epasts`) VALUES
                                                ('".$id."', '".date('y-m-d')."', '".$_POST['Iela']."', '".$_POST['Telpa']."', 'Neatrisināts', '".$_POST['Prob']."', '".$_POST['Piez']."', '1', '".$_SESSION['email']."')");
         header('location:index.php');
        }
     ?>


     <select class="form-select" id="Iela"name="Iela">
        <option selected>Lūdzu izvēlaties ielu</option>
        <option value="Vānes iela">Vānes iela</option>
        <option value="Ventspils iela">Ventspils iela</option>
     </select>
        <input class="telpa" type="text" placeholder="Telpa" name="Telpa" />
        <input class="parejais" type="text" placeholder="Problēma" name="Prob" />
	    <input class="parejais" type="text" placeholder="Piezīme" name="Piez"/>
	    <input class="pievienot" type= "submit" name="submit1" value="Pievienot"/>
	</form>





<footer>
        Liepajas Valsts Tehnikums &copy; 2023
</footer>

<script src="files/script.js"></script>
</body>
</html>