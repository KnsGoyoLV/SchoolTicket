<?php 
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
        <a href="index.php"><i class="fas fa-home"></i> Sākumlapa</a>
        <a href="newinfo.php"> <i class="fas fa-plus"></i>Pievienot atbalsta biļeti</a>
        <a href="#"><i class="active"  class="fas fa-circle-info"></i>Jaunumi</a>
    </nav>
    <nav class="navbar">
    <a hred="login.php"><b><?php 		
         echo " <a href='login.php'><b>" . $_SESSION['username'] . $_SESSION['surname'] . "</b> <i class='fas fa-power-off'></i></a>";
     ?> </b>
    
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</header>

<section id="adminSakums">


    <div class="row">
        <div class="info">
            <div class="head-pan">
                TEKSTS IET SEIT
        </div>
        
    </div>
</section>

<section id="adminSakums">
    <div class="kopsavilkums">
        <h1><i class="fas fa-user"></i>Lietotaja Informacija</h1>
    </div>

    <div class="row">
        <div class="info">
        <table>
                <tr>
                    <th>Lietotaj Vards</th>
                    <th>E-pasts</th>
                    <th>Admin Status</th>
                    <th>Lietotaj id</th>
                </tr>
                <?php
               
                  
                ?>
               
            </table>
        
    </div>

</section>

<footer>
        Liepajas Valsts Tehnikums &copy; 2023
</footer>

<script src="files/script.js"></script>
</body>
</html>