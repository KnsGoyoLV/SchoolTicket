<?php
include("../functions/function.php");
require "../vendor/autoload.php";
MicrosoftInfo();
Invalid_seasson();
block_domain();
include("..\database\connectDB.php");
?>
<!DOCTYPE html>
<html lang="lv">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LVT TicketSupport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"> 
    <link rel="stylesheet" href="style.css">
</head>
<body>
<!--Main Navigation-->
<header>
<!-- Sidebar -->
  <nav id="sidebarMenu" class="collapse d-xl-block sidebar collapse " style="background-color: #1c4c7c;">
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
        <a
          href="#"
          class="list-group-item list-group-item-action py-2 ripple active"
          aria-current="true"
        >
          <i class="fas fa-tachometer-alt fa-fw me-3 a"></i><span>Pieteikuma pārskats</span>
        </a>
        <a href="kons.php" class="list-group-item list-group-item-action py-2 ripple">
          <i class="fas fa-chart-area fa-fw me-3"></i><span>Konsultāciju saraksts</span>
        </a>
        <a href="#" class="list-group-item list-group-item-action py-2 ripple"
          ><i class="fas fa-lock fa-fw me-3"></i><span>Konsultāciju pārskats</span></a
        >
      </div>
    </div>
  </nav>
  <!-- Sidebar -->
  <!-- Navbar -->
  <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-gray fixed-top">
    <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <button
        class="navbar-toggler"
        type="button"
        data-mdb-toggle="collapse"
        data-mdb-target="#sidebarMenu"
        aria-controls="sidebarMenu"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <i class="fas fa-bars"></i>
      </button>
      <!-- Brand -->
      <a class="navbar-brand" href="#">
      <a href="#" class="animate-charcter" >Liepajas Valsts tehnikums </a>
      </a>
      <!-- Search form -->
      <!-- Right links -->
      <ul class="navbar-nav ms-auto d-flex flex-row">
        <!-- Notification dropdown -->
        <!-- Avatar -->
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center"
            href="#"
            id="navbarDropdownMenuLink"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
          <?= $_SESSION['username'];?>  <?= $_SESSION['surname'];?>
          </a>
          <ul
            class="dropdown-menu dropdown-menu-end"
            aria-labelledby="navbarDropdownMenuLink"
          >
            <li>
              <a class="dropdown-item" href="#">My profile</a>
            </li>
            <li>
              <a class="dropdown-item" href="#">Settings</a>
            </li>
            <li>
              <a class="dropdown-item" href="../logout.php">Logout</a>
            </li>
          </ul>
        </li>    
      </ul>
      <form class="searchb" method="post">
        <input
          autocomplete="off"
          type="search"
          class="form-control rounded"
          placeholder='Meklēt'
          style="min-width: 225px;"
          name = "searchbar"
        />
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
        if(isset($_POST['searchbar']))
        $keyword = $_POST['searchbar'];

        if(isset($keyword) && !empty($keyword)){
        $result = $pdo->query("SELECT * FROM pieteikums where telpa like '%$keyword%' or status like '%$keyword%' or iela like '%$keyword%' or problema  like '%$keyword%' or piezimes  like '%$keyword%' or epasts  like '%$keyword%' ORDER BY `pieteikums`.`laiks` DESC");
        }else{
          $result = $pdo->query("SELECT * FROM pieteikums ORDER BY `pieteikums`.`laiks` DESC");
         
        }
        $total = $pdo->query("SELECT * FROM pieteikums");
        $done = $pdo->query("SELECT * FROM pieteikums where (status ='Atrisināts') or (status = 'Atrisināts(Parbaudīts)') ");
        $not_done =  $pdo->query("SELECT * FROM pieteikums where (status ='Neatrisināts')");
        $proces =  $pdo->query("SELECT * FROM pieteikums where (status ='Procesā')");

        $rows = $result->fetchAll();
      
?>


<div class="container pt-4 ">
<div class="jumbotron ">
<div class="row w-100">
        <div class="col-md-3">
            <div class="card border-info mx-sm-1 p-3">
                <div class="card border-info shadow text-info p-3 my-card" ><i class="fa fa-list-alt" aria-hidden="true"></i></div>
                <div class="text-info text-center mt-3"><h4>Kopā</h4></div>
                <div class="text-info text-center mt-2"><h1><?= $total->rowCount();?></h1></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-success mx-sm-1 p-3">
                <div class="card border-success shadow text-success p-3 my-card"><i class="fa fa-check-circle" aria-hidden="true"></i></div>
                <div class="text-success text-center mt-3"><h4>Pabeigtie</h4></div>
                <div class="text-success text-center mt-2"><h1><?= $done->rowCount();?></h1></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-danger mx-sm-1 p-3">
                <div class="card border-danger shadow text-danger p-3 my-card" ><i class="fa fa-times-circle" aria-hidden="true"></i></div>
                <div class="text-danger text-center mt-3"><h4>Nepabeigtie</h4></div>
                <div class="text-danger text-center mt-2"><h1><?= $not_done->rowCount();?></h1></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-warning mx-sm-1 p-3">
                <div class="card border-warning shadow text-warning p-3 my-card" ><i class="fa fa-spinner" aria-hidden="true"></i></div>
                <div class="text-warning text-center mt-3"><h4>Procesā</h4></div>
                <div class="text-warning text-center mt-2"><h1><?= $proces->rowCount();?></h1></div>
            </div>
        </div>
     </div>
</div>
<div class="table-responsive-md" >
  <table class="mw-100" alt="Max-width 100%">
  <thead class="thead-dark">
    <tr>
      <th class="th-sm">Skolotajs</th>
      <th class="th-sm">Iela un telpa/datums</th>
      <th class="th-sm">Problēma</th>
      <th class="th-sm">Piezīme</th>
      <th class="th-sm">Statuss</th>
      <th class="th-sm">IT/remonta darbs</th>
      <th class="th-sm">Rediģēt</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($rows as $row) {
      $name_surname = NameSurname($row['epasts']);
      ?>
         <tr>
        <td>
        <div class="d-flex align-items-center">
          <div class="ms-6">
            <p class="fw-bold mb-1"><?= $name_surname['name'];?> <?= $name_surname['surname'];?></p>
            <p class="text-muted mb-1"><?= $row['epasts'];?>  </p>
          </div>
        </div>
      </td>
      <td>
        <div class="d-flex align-items-center">
          <div class="ms-6">
          <p class="fw-bold mb-1"><?= $row['laiks'];?></p>
            <p class="text-muted mb-1"><?= $row['iela'];?>: <?= $row['telpa'];?></p>
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
         if($row['status'] == 'Atrisināts'){
          ?>
           <span class="badge badge-outline-warning"> <?= $row['status'];?></span>

          <?php
         }
         elseif( $row['status'] == 'Atrisināts(Parbaudīts)'){
          ?>
          <span class="badge badge-outline-success"> <?= $row['status'];?></span>
          <?php
         }
         else{
         ?>
          <span class="badge badge-outline-info"> <?= $row['status'];?></span>
           <?php
          }
          ?>
      </td>
      <td>TODO:</td>
      <td>
        <?php
            if(isset($_POST['complete'.$row['ticket_id']]) ){
              $pdo->query("UPDATE pieteikums SET status='Atrisināts' WHERE ticket_id='".$row['ticket_id']."'");
             }
             if(isset($_POST['delete'.$row['ticket_id']]) ){
              $pdo->query("DELETE FROM pieteikums WHERE ticket_id='".$row['ticket_id']."'");
             }

             if(isset( $_POST['delete'.$row['ticket_id']]) || isset($_POST['complete'.$row['ticket_id']])){
              echo("<meta http-equiv='refresh' content='1'>");
             }        

             $id = $row['ticket_id'];
        ?>
        <form method="post">
            <button type="submit" class="btn btn-success btn-rounded" name="complete<?=$row['ticket_id'];?>" value=<?=$row['ticket_id'];?>>Apstiprināt</button>
            <button type="button" class="btn btn-danger btn-rounded" data-bs-toggle="modal" data-bs-target="#exampleModal" name="delete<?=$row['ticket_id'];?>"value=<?=$row['ticket_id'];?>>Izdzēst</button>
            <button type="button" class="btn btn-warning btn-rounded" data-bs-toggle="modal" data-bs-target="#staticBackdrop" name="edit<?=$row['ticket_id'];?>"value=<?=$row['ticket_id'];?>>Rediģēt</button>
         </form>
      </td>

    </tr>
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
        <button type="button" class="btn btn-primary">Jā</button>
      </div>
    </div>
  </div>
</div>

        <!-- Modal --> 
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
<select class="form-select" id="Iela"name="Iela"required>
    <div></div>
        <option selected>Izvēlēties ielu</option>
        <option value="Vānes iela">Vānes iela</option>
        <option value="Ventspils iela">Ventspils iela</option>
     </select>
     <span class="input-group-text"><i class="fa fa-home" aria-hidden="true"></i></span>
     <input type="text" class="form-control" placeholder="Telpa" aria-label="Telpa"value="<?=$row['telpa'];?>">
</div>
<div class="input-group mb-3">
<span class="input-group-text"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
  <span class="input-group-text" id="basic-addon1">Problēma</span>
  <input type="text" class="form-control" name="Prob" placeholder="Problēma" required maxlength="95" aria-describedby="basic-addon1" value="<?=$row['problema'];?>">
</div>
<div class="input-group">
<span class="input-group-text"><i class="fa fa-comments" aria-hidden="true"></i></span>
  <span class="input-group-text">Piezīme</span>
  <textarea class="form-control"name="Piez" placeholder="Piezīme" aria-label="With textarea" value="<?= $row['piezimes'];?>"></textarea>
  <?php
  ?>
</div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Aizvērt</button>
        <button type="button" class="btn btn-primary">Saglabāt</button>
      </div>
    <?php
    }
    ?>
  </tbody>
</table> 
  </div>   
  </div>
  
</main>
<!--Main layout-->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  


</body>
</html>