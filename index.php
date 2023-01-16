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
        // If we dont have an  code then get one
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
    $result = mysqli_query($db, "SELECT epasts,loma FROM lietotajs WHERE epasts = '".$_SESSION['email']."'");
    if($result->num_rows > 0){
    // if microsoft email is found in our Database get his user type
    //Selects user type and sets it to session
    while ($row = $result->fetch_assoc()) {
        $_SESSION['type'] = $row['loma'];
    }

    }
    else{
        // if not found in our Database then ask what his user type is 
       // header("Location:privlages.php");
       // exit();
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

<body>

<header>
    <a href="#" class="animate-charcter">Liepajas Valsts Tehnikums</a>
    <nav class="navbar">
        <a href="#sakums"class="active"><i class="fas fa-home"></i>Sākumlapa</a>
        <a href="newinfo.php"><i class="fas fa-plus"></i>Pievienot atbalsta biļeti</a>
        <a href="info.php"><i class="fas fa-circle-info"></i>Jaunumi</a>
    </nav>
    <nav class="navbar">
    <a hred="login.php"><?php 		
         echo " <a href='startpage'><b style='font-family: ui-sans-serif;'>" .$_SESSION['username']." ".$_SESSION['surname']. "</b> <i class='fas fa-power-off'></i></a>";
     ?> 
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</header>

<section id="adminSakums">

    <div class="row">
        <div class="info">
            <div class="head-info"><b>Jūsu atbalsta biļetes:</b></div>
            <table >
                <tr>
                
                    <th>Datums</th>
                    
                    <th>Iela</th>
                    <th>Klase</th>
                    <th>Problēmas</th>
                    <th>Piezīmes</th>                  
                    <th>Statuss</th>
                </tr>
               
                <?php
               

               $result = mysqli_query($db, "SELECT * from ticket");
               if($result){
                

                 while($row = mysqli_fetch_assoc($result)){
                     echo "<tr>";
                   //  echo"<td>" . $row['ticket_id'] . "</td>" ;
                     echo"<td>" . $row['laiks'] . "</td>" ;

                    //  echo"<td>Vards Uzvards</td>" ;
                     echo"<td>" . $row['iela'] . "</td>" ;
                     echo"<td>" . $row['klase'] . "</td>" ;
                     echo"<td>" . $row['problema'] . "</td>" ;
                     echo"<td>" . $row['piezime'] . "</td>" ;
                   //  echo"<td>" . $row['apstiprinats'] . "</td>" ;

              
                    // if database status is not done then print out status
                    
                    if($row['status'] != 'Pabeigts' )
                     echo"<td>" . $row['status'] . "</td>" ;  
                    elseif(isset($_COOKIE['buttonPressed']) && $_COOKIE['buttonPressed'] == "true"){
                            //echo 'weeee it works';
                            setcookie("buttonPressed", "", time()-3600);
                            $sql = "UPDATE `ticket` SET `apstiprinats` = '1', `status` = 'Pabeigts(pārbaudīts)' WHERE `ticket`.`ticket_id` = ".$row['ticket_id'];
                         mysqli_query($db, $sql);
                         header("Refresh:0");  

                    }
                    else{  // else if  is done but not ver ified then print out asking to verified the
                        ?>
                        <td><button class="btn btn-success btn-sm" id="accept-button">Izdarīts</button></td>
                        <td><button class="btn btn-danger btn-sm" id="decline-button">Neizdarīts</button></td>
                        <script src="handler.js"></script>
                        <?php
                     }
                      
                    
                 }
               }
              
                ?>
            </table>
        </div>
    </div>
</section>
<footer>
    
        Liepajas Valsts Tehnikums &copy; 2023
</footer>

</body>
</html>