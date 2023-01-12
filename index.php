<?php
    require_once("connectDB.php");
    require "vendor/autoload.php";
    use myPHPnotes\Microsoft\Auth;
    use myPHPnotes\Microsoft\Handlers\Session;
    use myPHPnotes\Microsoft\Models\User;
    $env = parse_ini_file('ID.env');
    session_start();  
    $tenant =$env['tenant'];
    $client_id = $env['client_id'];
    $client_secret = $env['client_secret'];
    $callback = $env['callback'];
    $scopes = ["https://graph.microsoft.com/.default","offline_access"];
    $tent = Session::get("tenant_id");
    if (isset($_SESSION['used_codes']) && in_array($_GET['code'], $_SESSION['used_codes']) || !isset($_GET['code'])) {
        // If we dont have an authorization code then get one
        $microsoft = new Auth($tenant, $client_id, $client_secret,$callback, $scopes);
        header("location: " . $microsoft->getAuthUrl());
        exit;
    } else {
    // if the auth code hasnt been used get acces token
    $microsoft = new Auth(Session::get("tenant_id"),
    Session::get("client_id"),  
    Session::get("client_secret"), 
    Session::get("redirect_uri"), 
    Session::get("scopes"));

    $tokens = $microsoft->getToken($_GET['code'], Session::get("state"));
    $microsoft->setAccessToken($tokens->access_token);
    // add auth code to the used_codes after setting acces token and using the auth code
    if(!isset($_SESSION['used_codes'])){
        $_SESSION['used_codes']=[];
    }

    $_SESSION['used_codes'][] = $_GET['code'];
    }



  //Store user info 
    $user = (new User);
    $_SESSION['username'] = $user->data->getGivenName();
    $_SESSION['surname'] = $user->data->getSurname();
    $_SESSION['email'] = $user->data->getMail();
    $_SESSION['phone'] = $user->data->getMobilePhone();


  //Block subdomain 
  $parts = explode('@',  $_SESSION['email']);
  $domain = array_pop($parts);
  $blocked_domains = array('sk');// to block sub domain add sk in here
  if ( !$_SESSION['username'] == 'Daniels' && in_array(explode('.', $domain)[0], $blocked_domains)) {
    header("Location:blocked.php");
    exit();
  }
    $result = mysqli_query($db, "SELECT * from ticket");
    if($result){
        while($row = mysqli_fetch_assoc($result)){
            if($_SESSION['email'] == $row['epasts']){
                // if microsoft email is found in our Database get his user type
                $_SESSION['type'] = "SELECT ";//Selects user type and sets it to session

            }
            else{
                // if not found in our Database then ask what his user type is 
                header("Location:privlages.php");
                exit();
            }
        }
    }

  

?>

<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LVT TicketSupport</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="style_main.css">

</head>

<body>

<header>
    <a href="#" class="animate-charcter">Liepajas Valsts Tehnikums</a>
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
                $sql = "SELECT COUNT(*) FROM ticket";
                $result = $db->query($sql);
                if($result->num_rows>0)
                    while($row = $result->fetch_assoc())
                         $nunRows = $row["COUNT(*)"];
                echo "<span>$nunRows</span>"
            ?>
            <h3>Cik ir</h3>
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
            <h3>Iesākts</h3>
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
            <h3>Need to be verified</h3>
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

    <div class="row">
        <div class="info">
            <div class="head-info">Ruteri Noliktava:</div>
            <table>
                <tr>
                
                    <th>Datums</th>
                    <th>Vards Uzvards</th>
                  
                    <th>Klase</th>
                    <th>Problema</th>
                    <th>Piezime</th>
                    
                    <th>Status</th>
                </tr>
                <?php
               

               $result = mysqli_query($db, "SELECT * from ticket");
               if($result){
                

                 while($row = mysqli_fetch_assoc($result)){
                     echo "<tr>";
                   //  echo"<td>" . $row['ticket_id'] . "</td>" ;
                     echo"<td>" . $row['laiks'] . "</td>" ;
                     echo"<td>" . $row['vards'] ." ".$row['uzvards'] . "</td>" ;
                    // echo"<td>" . $row['iela'] . "</td>" ;
                     echo"<td>" . $row['klase'] . "</td>" ;
                     echo"<td>" . $row['problema'] . "</td>" ;
                     echo"<td>" . $row['piezime'] . "</td>" ;
                   //  echo"<td>" . $row['apstiprinats'] . "</td>" ;
                     echo"<td>" . $row['status'] . "</td>" ;
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