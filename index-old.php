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

<body>

<header>
    <a href="#" class="animate-charcter">Sixsense</a>
    <nav class="navbar">
        <a href="#sakums"class="active"><i class="fas fa-home"></i> Sākumlapa</a>
        <a href="info.php"><i class="fas fa-circle-info"></i> Informacijas</a>
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
        <div class="informacija">
            <?php
            require("connectDB.php");
            $sql = "SELECT COUNT(*) FROM user";
            $result = $db->query($sql);
            if($result->num_rows>0)
                while($row = $result->fetch_assoc())
                    $nunRows = $row["COUNT(*)"];
            echo "<span>$nunRows</span>"
            ?>
            <h3>Lietotaji</h3>
        </div>
        <div class="informacija">
        <?php
            require("connectDB.php");
            $sql = "SELECT COUNT(*) FROM darbinieki";
            $result = $db->query($sql);
            if($result->num_rows>0)
                while($row = $result->fetch_assoc())
                    $nunRows = $row["COUNT(*)"];
            echo "<span>$nunRows</span>"
            ?>
            <h3>Darbinieki</h3>
        </div>
        <div class="informacija">
            <?php
            require("connectDB.php");
            $sql = "SELECT COUNT(*) FROM klients";
            $result = $db->query($sql);
            if($result->num_rows>0)
                while($row = $result->fetch_assoc())
                    $nunRows = $row["COUNT(*)"];
            echo "<span>$nunRows</span>"
            ?>
            <h3>Klienti</h3>
        </div>
        <div class="informacija">
        <?php
            require("connectDB.php");
            $sql = "SELECT COUNT(*) FROM ruteramodel";
            $result = $db->query($sql);
            if($result->num_rows>0)
                while($row = $result->fetch_assoc())
                    $nunRows = $row["COUNT(*)"];
            echo "<span>$nunRows</span>"
            ?>
            <h3>Pieejamie Ruteri</h3>
        </div>
    </div>

    <div class="row">
        <div class="info">
            <div class="head-info">Ruteri Noliktava:</div>
            <table>
                <tr>
                    <th>ID Rutera</th>
                    <th>Rutera Nosaukums</th>
                    <th>Rutera Max internets mb/s</th>
                    <th>Rutera Modelis</th>
                </tr>
                <?php
                  require("connectDB.php");
                  $result = mysqli_query($db, "SELECT * from ruteramodel");
                  if($result){
                   

                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo"<td>" . $row['idRuteraModel'] . "</td>" ;
                        echo"<td>" . $row['RutereVards'] . "</td>" ;
                        echo"<td>" . $row['RuteraInternetsMax'] . "</td>" ;
                        echo"<td>" . $row['RuteraModels'] . "</td>" ;
                        echo "</tr>";
                    }
                  }
                ?>
               
            </table>
        </div>
        <div class="info2">
            <div class="head-info">Klienti:</div>
            <table>
                <tr>
                    <th>KlientID</th>
                    <th>Klienta Uzvards</th>
                    <th>Klienta Iela</th>
                    <th>Klienta Telefons</th>
                    <th>Liguma Nr.</th>
                    <th>Abonaments </th>
                </tr>
                <?php
                  require("connectDB.php");
                  $result = mysqli_query($db, "SELECT * from klients");
                  if($result){
                   

                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo"<td>" . $row['idKlients'] . "</td>" ;
                        echo"<td>" . $row['KlientaUzvards'] . "</td>" ;
                        echo"<td>" . $row['KlientaIela'] . "</td>" ;
                        echo"<td>" . $row['KlientaTel'] . "</td>" ;
                        echo"<td>" . $row['LigumaNr'] . "</td>" ;
                        echo"<td>" . $row['Abonaments_idAbonaments'] . "</td>" ;
                        echo "</tr>";
                    }
                  }
                ?>
            </table>
        </div>
    </div>
</section>

<footer>
    Sixsesne, Work fast with ease &copy; 2022
</footer>

<script src="files/script.js"></script>
</body>
</html>




















<div class="kopsavilkums">
        <div class="informacija">
            <?php            
                $sql = "SELECT COUNT(*) FROM ticket";
                $result = $db->query($sql);
                if($result->num_rows>0)
                    while($row = $result->fetch_assoc())
                         $nunRows = $row["COUNT(*)"];
                echo "<span>$nunRows</span>"
            ?>
            <h3>Kopējais skaits</h3>
        </div>
        <div class="informacija">
        <?php
                $sql = "SELECT COUNT(*) FROM ticket where status = 'Nav iesākts'";
                $result = $db->query($sql);
                if($result->num_rows>0)
                    while($row = $result->fetch_assoc())
                         $nunRows = $row["COUNT(*)"];
                echo "<span>$nunRows</span>"
            ?>
            <h3>Jaunās</h3>
        </div>
        <div class="informacija">
           <?php
               $sql = "SELECT COUNT(*) FROM ticket where status = 'Iesākts'";
               $result = $db->query($sql);
               if($result->num_rows>0)
                   while($row = $result->fetch_assoc())
                        $nunRows = $row["COUNT(*)"];
               echo "<span>$nunRows</span>"
            ?>
            <h3>Iesākts</h3>
        </div>
        <div class="informacija">
        <?php
              $sql = "SELECT COUNT(*) FROM ticket where status = 'Pabeigts'";
              $result = $db->query($sql);
              if($result->num_rows>0)
                  while($row = $result->fetch_assoc())
                       $nunRows = $row["COUNT(*)"];
              echo "<span>$nunRows</span>"
            ?>
            <h3>Pabeigts</h3>
        </div>
    </div>
