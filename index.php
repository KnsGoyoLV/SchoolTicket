<?php
  use myPHPnotes\Microsoft\Auth;
  use myPHPnotes\Microsoft\Handlers\Session;
  use myPHPnotes\Microsoft\Models\User;
  require "vendor/autoload.php";
  $env = parse_ini_file('ID.env');
  session_start();  

  $microsoft = new Auth(Session::get("tenant_id"),
                        Session::get("client_id"),  
                        Session::get("client_secret"), 
                        Session::get("redirect_uri"), 
                        Session::get("scopes"));
  
  $tokens = $microsoft->getToken($_REQUEST['code'], Session::get("state"));
  $microsoft->setAccessToken($tokens->access_token);

  //Store user info 
  $user = (new User);
  $_SESSION['username'] = $user->data->getGivenName();
  $_SESSION['surname'] = $user->data->getSurname();
  $_SESSION['email'] = $user->data->getMail();


  //Block subdomain 
  $parts = explode('@',  $_SESSION['email']);
  $domain = array_pop($parts);
  $blocked_domains = array('sk');// to block sub domain add sk in here
  if ( !$_SESSION['username'] == 'Daniels' && in_array(explode('.', $domain)[0], $blocked_domains)) {
    header("Location:blocked.php");
    exit();
  }
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

<body>

<header>
    <a href="#" class="animate-charcter">Sixsense</a>
    <nav class="navbar">
        <a href="#sakums"class="active"><i class="fas fa-home"></i> Sākumlapa</a>
        <a href="info.php"><i class="fas fa-circle-info"></i> Informacijas</a>
        <a href="newinfo.php"><i class="fas fa-wifi"></i> Pievienot Rūteri</a>
        <?php
          
            $IsAdmin = 1;
            if ($IsAdmin)   
                if (true)
                    echo "<a href='http://localhost/phpmyadmin/index.php'><i class='fas fa-cog'></i> Iestatījumi</a>";
                
              
        ?>
    </nav>
    <nav class="navbar">
    <a hred="login.php"><b><?php 		
         echo " <a href='startpage'><b>" .$_SESSION['username']." ".$_SESSION['surname']. "</b> <i class='fas fa-power-off'></i></a>";
     ?> </b>
    
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</header>

<section id="adminSakums">
    <div class="kopsavilkums">
        <div class="informacija">
            <?php
            echo "<span>23</span>";
            echo "<h3>".$_SESSION['IDe']."</h3>";
            ?>
            
        </div>
        <div class="informacija">
        <?php
           
           
            echo "<span>25</span>"
            ?>
            <h3>Darbinieki</h3>
        </div>
        <div class="informacija">
           <?php
            echo "<span>26</span>"
            ?>
            <h3>Klienti</h3>
        </div>
        <div class="informacija">
        <?php
            echo "<span>27</span>"
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
               

                  if(true){
                   
                    /*
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo"<td>" . $row['idRuteraModel'] . "</td>" ;
                        echo"<td>" . $row['RutereVards'] . "</td>" ;
                        echo"<td>" . $row['RuteraInternetsMax'] . "</td>" ;
                        echo"<td>" . $row['RuteraModels'] . "</td>" ;
                        echo "</tr>";
                    }
                    */
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
                 
                 
                  if(true){
                   
                    /*
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
                    */
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