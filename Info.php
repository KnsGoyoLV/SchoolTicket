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
    <a href="#" class="animate-charcter">Sixsense</a>
    <nav class="navbar">
        <a href="index.php"><i class="fas fa-home"></i> Sākumlapa</a>
        <a href="#informacija"class="active"><i class="fas fa-circle-info"></i> Informacijas</a>
        <a href="newinfo.php"><i class="fas fa-wifi"></i> Pievienot Rūteri</a>
        <?php
          require("connectDB.php");
          session_start();
          $IsAdmin = $db->query("SELECT * FROM user WHERE IsAdmin = true AND username = '".$_SESSION['username']."'");
            if ($IsAdmin)   
                if ($IsAdmin->num_rows > 0)
                    echo "<a href='http://localhost/phpmyadmin/index.php'><i class='fas fa-cog'></i> Iestatījumi</a>";
                
              
        ?>
    </nav>
    <nav class="navbar">
    <a hred="login.php"><b><?php 		
         echo " <a href='login.php'><b>" . $_SESSION['username'] . "</b> <i class='fas fa-power-off'></i></a>";
     ?> </b>
    
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</header>

<section id="adminSakums">
    <div class="kopsavilkums">
        <h1><i class="fas fa-wifi"></i> Internet Pakalpojuma Veikals</h1>
    </div>

    <div class="row">
        <div class="info">
            <div class="head-pan">Eksamen Darbs Par DatuBazēm <br>  <br> 
                SQL datababāze ar ER diagramu, <br> 
                Apache 2.0 ar ieejas lapu un administracijas paneli, <br> <br> 
                Daniels Vidopskis 4PT  &copy; 2022  </div>
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
                    <th>Parole</th>
                    <th>Izveides Datums</th>
                    <th>Admin Status</th>
                    <th>Lietotaj id</th>
                </tr>
                <?php
                  require("connectDB.php");
                  $result = mysqli_query($db, "SELECT * from user");
                  if($result){
                   

                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo"<td>" . $row['username'] . "</td>" ;
                        echo"<td>" . $row['email'] . "</td>" ;
                        echo"<td>" . $row['password'] . "</td>" ;
                        echo"<td>" . $row['create_time'] . "</td>" ;
                        echo"<td>" . $row['IsAdmin'] . "</td>" ;
                        echo"<td>" . $row['userid'] . "</td>" ;
                        echo "</tr>";
                    }
                  }
                ?>
               
            </table>
        
    </div>

</section>

<footer>
    Sixsesne, Work fast with ease &copy; 2022
</footer>

<script src="files/script.js"></script>
</body>
</html>