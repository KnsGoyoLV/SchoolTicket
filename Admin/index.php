<?php
require_once("../database/connectDB.php");

$env = parse_ini_file('../database/.env');
session_start();

?>
<!DOCTYPE html>
<html lang="lv">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LVT TicketSupport</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
</head>

<body style="background-image: url('../assets/back.png');background-repeat: no-repeat; background-attachment: fixed;
  background-size: 100% 100%;">
  <section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <div class="mb-md-5 mt-md-4 pb-5">

                <h2 class="fw-bold mb-2 text-uppercase">Admin Panel</h2>
                <p class="text-white-50 mb-5">Lūdzu ierakstiet e-pastu un paroli!</p>
                <?php       
                  if (isset($_POST['login'])) {
                    
                    if(empty($_POST['epasts1']) || empty($_POST['parole'])  ){
                    echo '<div class="alert alert-danger" role="alert">';
                    echo 'Epasts vai parole netika aizpildīta:';
                    echo '</div>';
                    }
                    else{    
                      $ipEmail = $_POST['epasts1'];
                      $ipPassword = $_POST['parole'];
              
                      // Retrieve admin login information from the database
                      $query = $pdo->prepare("SELECT epasts, parole FROM `admin login` WHERE epasts = :email");
                      $query->bindParam(':email', $ipEmail);
                      $query->execute();
                      $row = $query->fetch(PDO::FETCH_ASSOC);
                      if ($row) {
                        $storedPassword = $row['parole'];
            
                        
                        if (password_verify($ipPassword, $storedPassword)) {   
                          $_SESSION['email1'] = $_POST['epasts1'];
                          header("location:panel.php");
                            
                        } else {
                            echo '<div class="alert alert-danger" role="alert">';
                            echo 'Nepareizs Epasts vai parole!';
                            echo '</div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger" role="alert">';
                        echo 'Nepareizs Epasts vai parole!';
                        echo '</div>';
                    }
                    }
                  }
                ?>
                <form method="post">
                <div class="form-outline form-white mb-4">
                  <label class="form-label">Epasts</label>
                  <input type="email" id="epasts1" name="epasts1" class="form-control form-control-lg" >
                </div>

                <div class="form-outline form-white mb-4">
                  <label class="form-label">Parole</label>
                  <input type="password" id="parole"name="parole" class="form-control form-control-lg" >
                </div>

                <button class="btn btn-outline-light btn-lg px-5" type="submit">Register</button>
                <button class="btn btn-outline-light btn-lg px-5" type="submit" name="login">Login</button>
                <hr class="my-2">
                
                  <a class="btn btn-lg btn-block btn-primary mb-2" style="background-color: #3b5998;"
                    href="Admin_login.php" class="button"><i class="fa-brands fa-windows"></i> Ienākt ar microsoft</a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>



</body>

</html>