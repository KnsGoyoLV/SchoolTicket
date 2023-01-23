<?php 
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
<a href="#" class="animate-charcter">Liepajas Valsts Tehnikums</a>
    <nav class="navbar">
        <a href="index.php"><i class="fas fa-home"></i> Sākumlapa</a>
        <a href="newinfo.php"> <i class="fas fa-plus"></i>Pievienot atbalsta biļeti</a>
        <a href=""class="active"><i class="fas fa-circle-info"></i>Informacija</a>
    </nav>
    <nav class="navbar">
    <a hred="login.php"><b><?php 		
         echo " <a href='login.php'><b>" . $_SESSION['username'] . $_SESSION['surname'] . "</b> <i class='fas fa-power-off'></i></a>";
     ?> </b>
    
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</header>

<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<div class="container bootstrap snippets bootdey">
    <div class="col-md-12">
        <div class="profile-container">
            <div class="profile-header row">
                <div class="col-md-4 col-sm-12 text-center">
                    <img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="header-avatar">
                </div>
                <div class="col-md-8 col-sm-12 profile-info">
                    <div class="header-fullname">Vards uzvards</div>
                    <div class="header-information">
                      Role(kip vai skolotajs vai admin)
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 profile-stats">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12 stats-col">
                            <div class="stats-value pink">1</div>
                            <div class="stats-title">Cik ielikti ticketi</div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 stats-col">
                            <div class="stats-value">e pasts</div>
                            <div class="stats-title">epasts</div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 stats-col">
                            <div class="stats-value pink">kko vel ja vaig</div>
                            <div class="stats-title">kko vel ja vaig</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4 inlinestats-col">
                            <i class="glyphicon glyphicon-map-marker"></i> Liepajas Valsts Tehnikums
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 inlinestats-col">
                            nezinu: <strong>hz</strong>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 inlinestats-col">
                            nezinu: <strong>hz</strong>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>
</div>

<footer>
        Liepajas Valsts Tehnikums &copy; 2023
</footer>

<script src="files/script.js"></script>
</body>
</html>