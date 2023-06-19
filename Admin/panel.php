<?php

include("../functions/function.php");
MicrosoftInfo();
Invalid_session($_SESSION['email']);
block_domain();
include("..\database\connectDB.php");
?>
<!DOCTYPE html>
<html lang="lv">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LVT Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <!--Main Navigation-->
  <header>
    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-gray fixed-top">
      <!-- Container wrapper -->
      <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
          aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
        <!-- Brand -->
        <a class="navbar-brand" href="#">
          <a href="../index.php" class="animate-charcter">Liepājas Valsts tehnikums </a>
        </a>
        <!-- Search form -->
        <!-- Right links -->
        <ul class="navbar-nav ms-auto d-flex flex-row">
          <!-- Notification dropdown -->
          <!-- Avatar -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
              id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?= $_SESSION['username']; ?> <?= $_SESSION['surname']; ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
              <li>
                <a class="dropdown-item" href="../index.php">Skolotāja skats</a>
              </li>
              <li>
                <a class="dropdown-item" href="../tasker/task.php">Saimniecības nodaļas skats</a>
              </li>
              <li>
                <a class="dropdown-item" href="../logout.php">Izrakstīties</a>
              </li>
            </ul>
          </li>
        </ul>
        <form class="searchb" method="post">
          <input autocomplete="off" type="search" class="form-control rounded" placeholder='Meklēt'
            style="min-width: 225px;" name="searchbar" />
          <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
        </form>
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
  </header>
  <!--Main Navigation-->
  <!--Main layout-->
  <main style="margin-top: 58px;">

    <?php
    // searchbar query stuff that search for stuff
    if (isset($_POST['searchbar']))
      $keyword = $_POST['searchbar'];

    if (isset($keyword) && !empty($keyword)) {
      $result = $pdo->query("SELECT * FROM pieteikums where telpa like '%$keyword%' or status like '%$keyword%' or iela like '%$keyword%' or problema  like '%$keyword%' or piezimes  like '%$keyword%' or epasts  like '%$keyword%' ORDER BY `pieteikums`.`laiks` DESC");
    } else {
      $result = $pdo->query("SELECT * FROM pieteikums ORDER BY `pieteikums`.`laiks` DESC");
    }
    // get count of every status tickets 
    $done = $pdo->query("SELECT * FROM pieteikums where (status ='Atrisināts') or (status = 'Atrisināts(Parbaudīts)') ");
    $notdone = $pdo->query("SELECT * FROM pieteikums where (status ='Neatrisināts')");
    $proces = $pdo->query("SELECT * FROM pieteikums where (status ='Procesā')");

    if (isset($_GET['total']) && $_GET['total'] === 'true') {
      $rows = $result->fetchAll();
    }
    if (isset($_GET['done']) && $_GET['done'] === 'true') {
      $rows = $done->fetchAll();
    }
    if (isset($_GET['notdone']) && $_GET['notdone'] === 'true') {
      $rows = $notdone->fetchAll();
    }
    if (isset($_GET['process']) && $_GET['process'] === 'true') {
      $rows = $proces->fetchAll();
    }

    ?>
    <div class="container pt-4 ">
      <div class="jumbotron ">
        <div class="row w-100">
          <div class="col-md-3">
            <div class="card border-info mx-sm-1 p-3">
              <div class="card border-info shadow text-info p-3 my-card"><i class="fa fa-list-alt"
                  aria-hidden="true"></i></div>
              <div style="cursor: pointer;" class="text-info text-center mt-3">
                <a id="total" class="together" href="#">Kopā</a>
              </div>
              <div class="text-info text-center mt-2">
                <h1>
                  <?= $result->rowCount(); ?>
                </h1>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card border-success mx-sm-1 p-3">
              <div class="card border-success shadow text-success p-3 my-card"><i class="fa fa-check-circle"
                  aria-hidden="true"></i></div>
              <div style="cursor: pointer;" class="text-success text-center mt-3">
                <a id="done" class="done" href="#">Pabeigtie</a>
              </div>
              <div class="text-success text-center mt-2">
                <h1>
                  <?= $done->rowCount(); ?>
                </h1>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card border-danger mx-sm-1 p-3">
              <div class="card border-danger shadow text-danger p-3 my-card"><i class="fa fa-times-circle"
                  aria-hidden="true"></i></div>
              <div style="cursor: pointer;" class="text-danger text-center mt-3">
                <a id="notdone" class="notdone" href="#">Nepabeigtie</a>
              </div>
              <div class="text-danger text-center mt-2">
                <h1>
                  <?= $notdone->rowCount(); ?>
                </h1>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card border-warning mx-sm-1 p-3">
              <div class="card border-warning shadow text-warning p-3 my-card"><i class="fa fa-spinner"
                  aria-hidden="true"></i></div>
              <div style="cursor: pointer;" class="text-warning text-center mt-3">
                <a id="process" class="process" href="#">Procesā</a>
              </div>
              <div class="text-warning text-center mt-2">
                <h1>
                  <?= $proces->rowCount(); ?>
                </h1>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="table-responsive-md">
        <table class="mw-100" alt="Max-width 100%">
          <thead class="thead-dark">
            <tr>
              <th class="th-sm">Skolotājs</th>
              <th class="th-sm">Iela un telpa/datums</th>
              <th class="th-sm">Problēma</th>
              <th class="th-sm">Piezīme</th>
              <th class="th-sm">Statuss</th>
              <th class="th-sm">IT/remonta darbs</th>
              <th class="th-sm">Rediģēt</th>
            </tr>
          </thead>
          <tbody id="tableBody">
            <?php
            if (!isset($rows)) {

            } else
              foreach ($rows as $row) {
                ?>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="ms-6">
                        <p class="fw-bold mb-1">
                          <?= $row['vards']; ?>
                          <?= $row['uzvards']; ?>
                        </p>
                        <p class="text-muted mb-1">
                          <?= $row['epasts']; ?>
                        </p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="ms-6">
                        <p class="fw-bold mb-1">
                          <?= $row['laiks']; ?>
                        </p>
                        <p class="text-muted mb-1">
                          <?= $row['iela']; ?>:
                          <?= $row['telpa']; ?>
                        </p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="fw-normal mb-2">
                      <?= $row['problema']; ?>
                    </p>
                  </td>
                  <td>
                    <span>
                      <?= $row['piezimes']; ?>
                    </span>
                  </td>
                  <td>
                    <?php
                    if ($row['status'] == 'Atrisināts') {
                      ?>
                      <span class="badge badge-outline-warning">
                        <?= $row['status']; ?>
                      </span>

                      <?php
                    } elseif ($row['status'] == 'Atrisināts(Parbaudīts)') {
                      ?>
                      <span class="badge badge-outline-success">
                        <?= $row['status']; ?>
                      </span>
                      <?php
                    } else {
                      ?>
                      <span class="badge badge-outline-info">
                        <?= $row['status']; ?>
                      </span>
                      <?php
                    }
                    ?>
                  </td>
                  <td>
                    <?= $row['nodala']; ?>
                  </td>
                  <td>
                    <?php
                    // change tickets status to complete
                    if (isset($_POST['complete' . $row['ticket_id']])) {
                      // $to = "danielsvidopskis@gmail.com";
                      // $subject = "Test Email";
                      // $message = "This is a test email sent using xampp SMTP server. HELLO FREND";

                      // $headers = "From: me@example.com\r\n";
                      // $headers .= "Reply-To: me@example.com\r\n";
                      // $headers .= "MIME-Version: 1.2\r\n";
                      // $headers .= "Content-type: text/html\r\n";

                      // if (mail($to, $subject, $message, $headers)) {
                      //   echo "Email sent successfully";
                      // } else {
                      //   echo "Email sending failed";
                      // }
                      $pdo->query("UPDATE pieteikums SET status='Atrisināts' WHERE ticket_id='" . $row['ticket_id'] . "'");
                    }
                    //delete ticket from the database
                    if (isset($_POST['delete1' . $row['ticket_id']])) {
                      $pdo->query("DELETE FROM pieteikums WHERE ticket_id='" . $row['ticket_id'] . "'");
                    }
                    //update tickets info 
                    if (isset($_POST['edit' . $row['ticket_id']])) {
                      $pdo->query("UPDATE `pieteikums` SET `iela` = '" . $_POST['Iela'] . "', `telpa` = '" . $_POST['Telpa'] . "', `problema` = '" . $_POST['Prob'] . "', `piezimes` = '" . $_POST['Piez'] . "', `nodala` = '" . $_POST['nodala'] . "' WHERE ticket_id = '" . $row['ticket_id'] . "'");
                    }

                    //simple refresh after the button has been pressed and the function above completed
                    if (isset($_POST['delete1' . $row['ticket_id']]) || isset($_POST['complete' . $row['ticket_id']]) || isset($_POST['edit' . $row['ticket_id']])) {
                      echo ("<meta http-equiv='refresh' content='1'>");
                    }
                    ?>
                    <form method="post">
                      <button type="submit" class="btn btn-success btn-rounded" name="complete<?= $row['ticket_id']; ?>"
                        value=<?= $row['ticket_id']; ?>>Atrisināts</button>
                      <button type="button" class="btn btn-danger btn-rounded" data-bs-toggle="modal"
                        data-bs-target="#delete<?= $row['ticket_id']; ?>">Izdzēst</button>
                      <button type="button" class="btn btn-warning btn-rounded" data-bs-toggle="modal"
                        data-bs-target="#edit<?= $row['ticket_id']; ?>">Rediģēt</button>

                      <!-- <button type="button" class="btn btn-info btn-rounded" data-bs-toggle="modal"
                        data-bs-target="#komment<?= $row['ticket_id']; ?>">Pievienot Komentāru</button> -->

                      <div class="modal fade" id="komment<?= $row['ticket_id']; ?>" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Aizsutīt Komentāru uz ēpastu</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <textarea class="form-control" name="Piez" aria-label="With textarea" value="comment"
                                <?= $row['ticket_id']; ?>>EU RAKSTI TE></textarea>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nē</button>
                              <button type="submit" name="" class="btn btn-primary">Jā</button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="modal fade" id="delete<?= $row['ticket_id']; ?>" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Apstiprinājums</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Vai tiešām vēlaties dzēst ierakstu?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nē</button>
                              <button type="submit" name="delete1<?= $row['ticket_id']; ?>"
                                class="btn btn-primary">Jā</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Modal -->
                      <div class="modal fade" id="edit<?= $row['ticket_id']; ?>" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Rediģēt informāciju</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="input-group mb-3">
                                <div class="input-group mb-3">
                                  <span class="input-group-text"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                  <select class="form-select" id="Iela" name="Iela" required>
                                    <div></div>
                                    <option selected value="<?= $row['iela']; ?>">Izvēlēties ielu</option>
                                    <option value="Vānes iela">Vānes iela</option>
                                    <option value="Ventspils iela">Ventspils iela</option>
                                  </select>
                                  <span class="input-group-text"><i class="fa fa-home" aria-hidden="true"></i></span>
                                  <input type="text" class="form-control" id="Telpa" name="Telpa" placeholder="Telpa"
                                    aria-label="Telpa" value="<?= $row['telpa']; ?>">
                                  <select class="form-select" id="nodala" name="nodala" required>
                                    <div></div>
                                    <option selected value="<?= $row['nodala']; ?>"> Izvēlēties nodaļu</option>
                                    <option value="IT">IT nodaļa</option>
                                    <option value="Saimniecības">Saimniecības nodaļa</option>
                                  </select>
                                </div>
                                <div class="input-group mb-3">
                                  <span class="input-group-text"><i class="fa fa-exclamation-circle"
                                      aria-hidden="true"></i></span>
                                  <span class="input-group-text" id="basic-addon1">Problēma</span>
                                  <input type="text" class="form-control" name="Prob" placeholder="Problēma" required
                                    maxlength="95" aria-describedby="basic-addon1" value="<?= $row['problema']; ?>">
                                </div>
                                <div class="input-group">
                                  <span class="input-group-text"><i class="fa fa-comments" aria-hidden="true"></i></span>
                                  <span class="input-group-text">Piezīme</span>
                                  <textarea class="form-control" name="Piez" aria-label="With textarea"
                                    value="<?= $row['piezimes']; ?>"><?= $row['piezimes']; ?></textarea>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Aizvērt</button>
                                <button type="submit" class="btn btn-primary" name="edit<?= $row['ticket_id']; ?>"
                                  value=<?= $row['ticket_id']; ?>>Saglabāt</button>
                              </div>
                    </form>
                  </td>
                </tr>
                <?php
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>

  </main>
  <!--Main layout-->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>

  <script>

    const total = document.getElementById('total');
    total.addEventListener('click', function () {
      // Get current URL
      let url = window.location.href;

      // Check if the URL has a query string
      if (url.includes("?")) {
        // Remove the query string
        url = url.split("?")[0];
      }

      // Add total=true to the URL
      url += url.includes("?") ? "&total=true" : "?total=true";

      // Update current URL with new query string
      window.location.href = url;
    });
    const done = document.getElementById('done');
    done.addEventListener('click', () => {

      let url = window.location.href;

      if (url.includes("?"))
        url = url.split("?")[0];


      url += url.includes("?") ? "&done=true" : "?done=true";

      window.location.href = url;
    });

    const notdone = document.getElementById('notdone');
    notdone.addEventListener('click', () => {
      let url = window.location.href;

      if (url.includes("?"))
        url = url.split("?")[0];


      url += url.includes("?") ? "&notdone=true" : "?notdone=true";

      window.location.href = url;
    });
    const process = document.getElementById('process');
    process.addEventListener('click', () => {
      let url = window.location.href;

      if (url.includes("?"))
        url = url.split("?")[0];


      url += url.includes("?") ? "&process=true" : "?process=true";

      window.location.href = url;
    });

  </script>

</body>

</html>