<?php
    require_once("database/connectDB.php");
    require "vendor/autoload.php";
    use Microsoft\Graph\Graph;

    $env = parse_ini_file('.env');
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
        }
        curl_close ($ch);
        header ('Location: ' . $callback);
   }
   // if acces token is invalid or not gotten then go back to login.php file
   if(!isset($_SESSION['t'])){
    header('location: login.php');
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
        <a href="#" class="navbar-brand">Liepajas Valsts Tehnikums</a>
        

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
              <a href="#Mainpage" class="nav-link"><i class="fas fa-home"></i>Sākum Lapa</a>
            </li>
            <li class="nav-item">
              <a href="newinfo.php" class="nav-link"><i class="fas fa-plus"></i>Pievienot Problēmas</a>
            </li>
            <li class="nav-item">
              <a href="info.php" class="nav-link"><i class="fas fa-circle-info"></i>Informācija</a>
            </li>
            <li class="nav-item">
                <a hred="logout.php"><?php 		
                echo " <a href='logout.php' style='font-family: ui-sans-serif;'>" .$_SESSION['username']." ".$_SESSION['surname']. "<i class='fas fa-power-off'></i></a>";     
                ?>
            </nav>
            </li>    
          </ul>
        </div>
      </div>
    </nav>

   
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</header>


<br /><br />  
           <div class="container">    
                <div class="table-responsive">  
                     <table id="employee_data" class="table">
                      <thead>  
                     <tr>
                    <th>Datums</th>
                    <th>Iela</th>
                    <th>Klase</th>
                    <th>Problēmas</th>
                    <th>Piezīmes</th>                  
                    <th>Statuss</th>
                </tr>
                </thead> 
                <tbody>
                <?php
               

                $result = $pdo->query("SELECT * FROM pieteikums WHERE epasts ='".$_SESSION['email']."'");
                $rows = $result->fetchAll();

                foreach ($rows as $row) {
                    echo "<tr>";
                    echo"<td>" . $row['laiks'] . "</td>" ;
                    echo"<td>" . $row['iela'] . "</td>" ;
                    echo"<td>" . $row['telpa'] . "</td>" ;
                    echo"<td>" . $row['problema'] . "</td>" ;
                    echo"<td>" . $row['piezimes'] . "</td>" ;

              
                    // if database status is not done then print out status
                    if($row['status'] != 'Atrisināts' )
                        echo"<td>" . $row['status'] . "</td>" ;  
                    elseif(isset($_POST['button'.$row['ticket_id']])&& $_POST['button'.$row['ticket_id']] == $row['ticket_id']){
                       // check if button+ticket id has any value and if it is the same with ticket_id,
                       // then we set the tickets status verified 
                        $pdo->query("UPDATE `pieteikums` SET `status` = 'Atrisināts(Parbaudīts)' WHERE `pieteikums`.`ticket_id` = ".$row['ticket_id']);
                        header("Refresh:0");
                    } else { // else if  is done but not verified then print out asking to verified the ticket
                        echo'
                        <td>
                        <form method="post">
                        <button type="submit" class="btn btn-success btn-sm"  name="button' . $row['ticket_id'] . '"  value="' . $row['ticket_id'] . '">Izdarīts</button>
                        <button class="btn btn-danger btn-sm"  id="dbutton' . $row['ticket_id'] . '" value="' . $row['ticket_id'] . '" >Neizdarīts</button>
                        </form>
                        </td>
                        ';
                    }
                    echo '</tr>';      
                }
                ?>
                </tbody>
                     </table>  
                </div>  
           </div>  

</section>

<table class="table align-middle mb-0 bg-white">
  <thead class="bg-light">
    <tr>
      <th>Datums</th>
      <th>Iela</th>
      <th>Klase</th>
      <th>Problēmas</th>
      <th>Piezīmes</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <div class="d-flex align-items-center">
          <img
              src="https://mdbootstrap.com/img/new/avatars/8.jpg"
              alt=""
              style="width: 45px; height: 45px"
              class="rounded-circle"
              />
          <div class="ms-3">
            <p class="fw-bold mb-1">John Doe</p>
            <p class="text-muted mb-0">john.doe@gmail.com</p>
          </div>
        </div>
      </td>
      <td>
        <p class="fw-normal mb-1">Software engineer</p>
        <p class="text-muted mb-0">IT department</p>
      </td>
      <td>
        <span class="badge badge-success rounded-pill d-inline">Active</span>
      </td>
      <td>Senior</td>
      <td>
        <button type="button" class="btn btn-link btn-sm btn-rounded">
          Edit
        </button>
      </td>
    </tr>
    <tr>
      <td>
        <div class="d-flex align-items-center">
          <img
              src="https://mdbootstrap.com/img/new/avatars/6.jpg"
              class="rounded-circle"
              alt=""
              style="width: 45px; height: 45px"
              />
          <div class="ms-3">
            <p class="fw-bold mb-1">Alex Ray</p>
            <p class="text-muted mb-0">alex.ray@gmail.com</p>
          </div>
        </div>
      </td>
      <td>
        <p class="fw-normal mb-1">Consultant</p>
        <p class="text-muted mb-0">Finance</p>
      </td>
      <td>
        <span class="badge badge-primary rounded-pill d-inline"
              >Onboarding</span
          >
      </td>
      <td>Junior</td>
      <td>
        <button
                type="button"
                class="btn btn-link btn-rounded btn-sm fw-bold"
                data-mdb-ripple-color="dark"
                >
          Edit
        </button>
      </td>
    </tr>
    <tr>
      <td>
        <div class="d-flex align-items-center">
          <img
              src="https://mdbootstrap.com/img/new/avatars/7.jpg"
              class="rounded-circle"
              alt=""
              style="width: 45px; height: 45px"
              />
          <div class="ms-3">
            <p class="fw-bold mb-1">Kate Hunington</p>
            <p class="text-muted mb-0">kate.hunington@gmail.com</p>
          </div>
        </div>
      </td>
      <td>
        <p class="fw-normal mb-1">Designer</p>
        <p class="text-muted mb-0">UI/UX</p>
      </td>
      <td>
        <span class="badge badge-warning rounded-pill d-inline">Awaiting</span>
      </td>
      <td>Senior</td>
      <td>
        <button
                type="button"
                class="btn btn-link btn-rounded btn-sm fw-bold"
                data-mdb-ripple-color="dark"
                >
          Edit
        </button>
      </td>
    </tr>
  </tbody>
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