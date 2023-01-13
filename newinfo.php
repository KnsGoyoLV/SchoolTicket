<?php
 require_once("connectDB.php");
 require "vendor/autoload.php";
 use myPHPnotes\Microsoft\Auth;
 use myPHPnotes\Microsoft\Handlers\Session;
 use myPHPnotes\Microsoft\Models\User;
 $env = parse_ini_file('ID.env');
 session_start();  
?>


<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inernet Veikals DV</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="style_main.css">

</head>

<body >

<header>
    <a href="#" class="animate-charcter">Liepajas Valsts Tehnikums</a>
    <nav class="navbar">
        <a href="index.php"><i class="fas fa-home"></i>Sākumlapa</a>
        <a href="#NewInfo" class="active"><i class="fas fa-circle-info"></i>Pievienot atbalsta biļeti</a>
        <a href="#info.php"><i class="fas fa-wifi"></i>Jaunumi</a>
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

<section id="adminSakums">
    <div class="kopsavilkums">
        <h1><i class="fas fa-circle-info"></i> Pievienot </h1>
    </div>
  
   


    <form method="post">
     <?php 
        if(isset($_POST['submit1'])){
        //require("connectDB.php");
        // $RuteraID = mysqli_real_escape_string($db, $_POST['RuteraID']);
        // $RuteraVards = mysqli_real_escape_string($db, $_POST['RuteraVards']);
        // $RIA = mysqli_real_escape_string($db, $_POST['RIA']);
        // $RuteraMod = mysqli_real_escape_string($db, $_POST['RuteraMod']);

        // $sql = "INSERT INTO `ticket` (`ticket_id`, `laiks`, `vards`, `uzvards`, `iela`, `klase`, `problema`, `piezime`, `apstiprinats`, `status`) VALUES
        //                             ('$RuteraID', '$RuteraVards', '$RIA', '$RuteraMod')";
        // mysqli_query($db, $sql);
        }
     ?>
        <input type="int" placeholder="RuteraID" name="RuteraID" />
        <input type="text" placeholder="Rutera Vards" name="RuteraVards" />
        <input type="int" placeholder="Rutera Internet ātrums" name="RIA" />
	    <input type="text" placeholder="Rutera Modelis" name="RuteraMod"/>
	    <input type= "submit" name="submit1" value="Pievienot"/>
	</form>


</section>



<footer>
    Sixsesne, Work fast with ease &copy; 2022
</footer>

<script src="files/script.js"></script>
</body>
</html>