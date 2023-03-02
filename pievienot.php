<?php
require_once("database/connectDB.php");
require "vendor/autoload.php";
session_start();

if (!isset($_SESSION['t'])) {
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <link rel="stylesheet" href="pievienot.css">



  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</head>

<body>

  <header style="">
    <nav class="navbar navbar-expand-lg bg-dark  navbar-dark py-3 fixed-top">
      <div class="container">
        <a href="index.php" class="animate-charcter">Liepajas Valsts tehnikums</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navmenu">
          <ul class="navbar-nav ms-auto  ">
            <li class="nav-item">
              <a href="login.php" class="nav-link"><i class="fas fa-home"></i>Sākumlapa</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link" style="background-color: #4782b5;"><i class="fas fa-plus"></i>Pievienot
                Pieteikumu</a>
            </li>
            <li class="nav-item">
              <a href="info.php" class="nav-link"><i class="fas fa-circle-info"></i>Informācija</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
                id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $_SESSION['username']; ?> <?= $_SESSION['surname']; ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                <li>
                  <a class="dropdown-item" href="functions/IsAdmin.php">Admin panelis</a>
                </li>
                <li>
                  <a class="dropdown-item" href="../logout.php">Izrakstīties</a>
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

  <body>

    <form class="container-md needs-validation" novalidate method="post">
      <div class="INFO">
        <p class="font- 'Nunito', sans-serif;">Ievadiet nepieciešamo informāciju</p>
      </div>
      <?php


      // Initialize the required fields array
      $required = array('nodala', 'Problēma', 'Telpa', 'Iela');

      // Initialize an empty error array
      $errors = array();

      // Check if the form has been submitted
      if (isset($_POST['submit1'])) {
        // Loop over the required fields and check for empty values
        foreach ($required as $field) {
          if (empty($_POST[$field])) {
            $errors[] = $field . ' lauks ir obligāts.';
          }else {
            // Store the submitted value in the data array
            $data[$field] = $_POST[$field];
          }
        }

        // If there are no errors, insert the form data into the database
        if (empty($errors)) {
          // Insert the form data into the database using an SQL query
          $pdo->query("INSERT INTO `pieteikums`  ( `iela`, `telpa`, `status`, `problema`, `piezimes`, `nodala`, `epasts`,`vards`,`uzvards`) VALUES
                          ('" . $_POST['Iela'] . "', '" . $_POST['Telpa'] . "', 'Neatrisināts', '" . $_POST['Problēma'] . "', '" . $_POST['Piez'] . "', '" . $_POST['nodala'] . "', '" . $_SESSION['email'] . "', '" . $_SESSION['username'] . "', '" . $_SESSION['surname'] . "')");
          // Redirect the user to a success page or display a success message
          header('location:index.php');
        }
      }
      // Display the error messages (if any)
      if (!empty($errors)) {
        echo '<div class="alert alert-danger" role="alert">';
        echo 'Lūdzu aizpildiet sekojošus laukus: ';
        echo implode(', ', $errors);
        echo '</div>';
      }
      function is_selected($value, $selected) {
        return $value === $selected ? 'selected' : '';
      }

      ?>
      <script>

      </script>
      <div class="input-group mb-3">
        <span class="input-group-text"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
        <select class="form-select" id="Iela" name="Iela" required >
          <div></div>
          <option value=""<?= isset($_POST['Iela']) ?  is_selected('', $_POST['Iela']): '' ?>>Izvēlēties ielu</option>
          <option value="Vānes iela" <?= isset($_POST['Iela']) ?  is_selected('Vānes iela', $_POST['Iela']) : ''?>>Vānes iela</option>
          <option value="Ventspils iela"<?= isset($_POST['Iela']) ?  is_selected('Ventspils iela', $_POST['Iela']): '' ?>>Ventspils iela</option>
        </select>
        <span class="input-group-text"><i class="fa fa-home" aria-hidden="true"></i></span>
        <input type="text" class="form-control" placeholder="Telpa" aria-label="Telpa"
          name="Telpa" maxlength="5" value="<?= isset($data['Telpa']) ? $data['Telpa'] : '' ?>">
        <br>
        <select class="form-select" id="nodala" name="nodala" required>
          <div></div>
          <option value="" <?= isset($_POST['nodala']) ?  is_selected('', $_POST['nodala']): '' ?>>Izvēlēties nodaļu</option>
          <option value="IT"<?= isset($_POST['nodala']) ?  is_selected('IT', $_POST['nodala']) : ''?> >IT nodaļa</option>
          <option value="Saimniecības"<?= isset($_POST['nodala']) ?  is_selected('Saimniecības', $_POST['nodala']) : ''?>>Saimniecības nodaļa</option>
        </select>
      </div>

      <div class="input-group mb-3">
        <span class="input-group-text"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
        <span class="input-group-text" id="basic-addon1">Problēma</span>
        <!-- After getting the error it dosent let you submit the ticket  !-->
        <input type="text" class="form-control" name="Problēma" placeholder="Problēma" maxlength="95"
          aria-describedby="inputGroupPrepend"value="<?= isset($data['Problēma']) ? $data['Problēma'] : '' ?>" required>
      </div>

      <div class="input-group">
        <span class="input-group-text"><i class="fa fa-comments" aria-hidden="true"></i></span>
        <span class="input-group-text">Piezīme</span>
        <textarea class="form-control" name="Piez" placeholder="Piezīme" maxlength="95"
          aria-label="With textarea" ></textarea>
      </div>

      <div class="submit">
        <button onclick="window.location.href='index.php'" href="index.php" class="btn btn-secondary btn-lg"
          style="background-color: red;">Atcelt</button>
        <button type="submit" name="submit1" value="Pievienot" class="btn btn-secondary btn-lg"
          style="background-color: limegreen;">Pievienot</button>
      </div>

    </form>

    <?php
    require "footer.php";
    ?>




  </body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
  integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>