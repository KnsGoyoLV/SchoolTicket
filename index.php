<?php
    require_once("database/connectDB.php");
    require "vendor/autoload.php";
    use Microsoft\Graph\Graph;

    $env = parse_ini_file('database/.env');
    session_start();

    $tenant =$env['tenant'];
    $client_id = $env['client_id'];
    $client_secret = $env['client_secret'];
    $callback = $env['callback']; 

    if (array_key_exists ('access_token', $_POST)){
        //save access_token to SESSION t variable
        $_SESSION['t'] = $_POST['access_token'];
        $t = $_SESSION['t'];
        $ch = curl_init ();
        //get users json data from /me/ endpoint
        curl_setopt ($ch, CURLOPT_HTTPHEADER, array ('Authorization: Bearer '.$t,
                                               'Conent-type: application/json'));
        curl_setopt ($ch, CURLOPT_URL, "https://graph.microsoft.com/v1.0/me/");
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        $rez = json_decode (curl_exec ($ch), 1);
        if (array_key_exists ('error', $rez)){
            //if we have a error dump everything that error gives us  
            var_dump ($rez['error']);       
            die();
        }
        else{// get users data from json with $rez variable name
            $_SESSION['username'] = $rez["givenName"];
            $_SESSION['surname'] = $rez["surname"];
            $_SESSION['email'] = $rez['mail'];
            $_SESSION['id'] = $rez["id"];
            $_SESSION['job'] = $rez["jobTitle"];
        }
        curl_close ($ch);
        header ('Location: ' . $callback);
   }
   // if acces token is invalid or not gotten then go back to login.php file
   if(!isset($_SESSION['t'])){
    header('location:login.php');
   }
   
    //Block subdomain 
    $parts = explode('@',  $_SESSION['email']);
    $domain = array_pop($parts);
    $blocked_domains = array('sk');// to block sub domain add sk in here
    
    if ( !$_SESSION['username'] == 'Daniels' && in_array(explode('.', $domain)[0], $blocked_domains)) {
        header("Location:blocked.php");
        exit();
    }

    // $result = $pdo->query("SELECT epasts,loma FROM lietotajs WHERE epasts = '".$_SESSION['email']."'");
    // if($result->rowCount() > 0){
    //     // if microsoft email is found in our Database get his user type
    //     //Selects user type and sets it to session
    //     while ($row = $result->fetch()) {
    //         $_SESSION['type'] = $row['loma'];
    //     }
    // }
    // else{
    //     // if not found in our Database then ask what his user type is 
    //     header("Location:privlages.php");
    //     exit();
    // }

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


<nav class="navbar navbar-expand-lg bg-dark  navbar-dark py-3 fixed-top">
      <div class="container">
        <a href="#" class="animate-charcter" >Liepajas valsts tehnikums</a>
        

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
              <a href="#Mainpage" class="nav-link" style="background-color: #4782b5;"><i class="fas fa-home"></i>Sākumlapa</a>
            </li>
            <li class="nav-item">
              <a href="pievienot.php" class="nav-link"><i class="fas fa-plus"></i>Pievienot pieteikumu</a>
            </li>
            <li class="nav-item">
              <a href="info.php" class="nav-link"><i class="fas fa-circle-info"></i>Informācija</a>
            </li>

            <!-- Username and surname with drop down menu for login and admin panel  !-->
            <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center"
            href="#"
            id="navbarDropdownMenuLink"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
          <?= $_SESSION ['username'];?>  <?= $_SESSION['surname'];?>
          </a>
          <ul
            class="dropdown-menu dropdown-menu-end"
            aria-labelledby="navbarDropdownMenuLink"
          >
            <li>
              <a class="dropdown-item" href="functions/IsAdmin.php">Admin panel</a>
            </li>
            <li>
              <a class="dropdown-item" href="../logout.php">Logout</a>
            </li>
          </ul>
        </li>
          </ul>
        </div>
      </div>
    </nav>
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</header>


<br /><br />  


<div class="pogaa">
<button type="button"  class="btn btn-success btn-rounded btn-lg float-right"><i class='fa fa-plus' style='color: white'><a href="pievienot.php"></i> Pievienot </button></a>
</div>



<table class="table align-middle mb-2 table-responsive">
  
  <thead class="thead-dark">
    <tr>
      <th>Iela un telpa/datums</th>
      <th>Problēma</th>
      <th>Piezīme</th>
      <th>Statuss</th>
      <th>IT/remonta darbs</th>
      <th>Apstiprināt</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // get tickets that are made by the user and get all data about it 
      $result = $pdo->query("SELECT * FROM pieteikums WHERE epasts ='".$_SESSION['email']."' ORDER BY `pieteikums`.`laiks` DESC");
      $rows = $result->fetchAll();
    foreach ($rows as $row) {
      ?>
         <tr>
      <td>
        <div class="d-flex align-items-center">
          <div class="ms-6">
            <p class="fw-bold mb-1"><?= $row['iela'];?>: <?= $row['telpa'];?></p>
            <p class="text-muted mb-1"><?= $row['laiks'];?></p>
          </div>
        </div>
      </td>
      <td>
        <p class="fw-normal mb-2"><?= $row['problema'];?></p>
      </td>
      <td>
        <span  ><?= $row['piezimes'];?></span>
      </td>
      <td>
      <?php
        // Prints out ticket status in table and changes the color of it 
         if($row['status'] == 'Atrisināts'){
          ?>
           <span class="badge badge-warning"> <?= $row['status'];?></span>

          <?php
         }
         elseif( $row['status'] == 'Atrisināts(Parbaudīts)'){
          ?>
          <span class="badge badge-success"> <?= $row['status'];?></span>
          <?php
         }
         else{
         ?>
          <span class="badge badge-info"> <?= $row['status'];?></span>
           <?php
          }
          ?>
      </td>
      <td>TODO:</td>
      <td>
        <form method="post">
      <?php
            if(isset($_POST['Done'.$row['ticket_id']]) ){
              $pdo->query("UPDATE `pieteikums` SET `status` = 'Atrisināts(Parbaudīts)' WHERE ticket_id='".$row['ticket_id']."'");
            }
            if(isset($_POST['Ndone'.$row['ticket_id']]) ){
              $pdo->query("UPDATE `pieteikums` SET `status` = 'Neatrisināts' WHERE ticket_id='".$row['ticket_id']."'");
            }

            if(isset($_POST['Done'.$row['ticket_id']]) ||isset( $_POST['Ndone'.$row['ticket_id']])){
              echo("<meta http-equiv='refresh' content='1'>");
            }    
         if($row['status'] == 'Atrisināts' ){
          ?>
            
            <button name="Done<?=$row['ticket_id'];?>" class="btn btn-link btn-sm btn-rounded">
              Izdarīts
            </button>
            <button name="Ndone<?=$row['ticket_id'];?>" class="btn btn-link btn-sm btn-rounded">
              Neizdarīts
            </button>


          <?php
         }else{

         
         ?>
           <p class="fw-normal mb-2">Pagaidām vēl nav atrisināts</p>
           <?php
          }
          ?>
         </form>
      </td>

    </tr>

  </tbody>
      


    <?php
    }


    ?>
    
</table>    

<div class="footer">
  <p> Liepajas Valsts Tehnikums &copy; 2023</p>
</div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
</body>
</html>