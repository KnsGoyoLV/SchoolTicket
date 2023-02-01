<?php
require_once("../database/connectDB.php");
session_start();

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
  <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-gray">
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
        <a
          href="#"
          class="list-group-item list-group-item-action py-2 ripple active"
          aria-current="true"
        >
          <i class="fas fa-tachometer-alt fa-fw me-3 a"></i><span>Pieteikuma pārskats</span>
        </a>
        <a href="#" class="list-group-item list-group-item-action py-2 ripple">
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
      <form class="d-none d-md-flex input-group w-auto my-auto" method="post">
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

      <!-- Right links -->
      <ul class="navbar-nav ms-auto d-flex flex-row">
        <!-- Notification dropdown -->
        <li class="nav-item dropdown">
          <a
            class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow"
            href="#"
            id="navbarDropdownMenuLink"
            role="button"
            data-mdb-toggle="dropdown"
            aria-expanded="false"
          >
            <i class="fas fa-bell"></i>
            <span class="badge rounded-pill badge-notification bg-danger">1</span>
          </a>
          <ul
            class="dropdown-menu dropdown-menu-end"
            aria-labelledby="navbarDropdownMenuLink"
          >
            <li>
              <a class="dropdown-item" href="#">Some news</a>
            </li>
            <li>
              <a class="dropdown-item" href="#">Another news</a>
            </li>
            <li>
              <a class="dropdown-item" href="#">Something else here</a>
            </li>
          </ul>
        </li>

        <!-- Icon -->
        <li class="nav-item">
          <a class="nav-link me-3 me-lg-0" href="#">
            <i class="fas fa-fill-drip"></i>
          </a>
        </li>
        <!-- Avatar -->
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center"
            href="#"
            id="navbarDropdownMenuLink"
            role="button"
            data-mdb-toggle="dropdown"
            aria-expanded="false"
          >
            Daniels Vidopskis
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
              <a class="dropdown-item" href="#">Logout</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- Container wrapper -->
  </nav>
  <!-- Navbar -->
</header>
<!--Main Navigation-->

<!--Main layout-->
<main style="margin-top: 58px;">
<div class="table-responsive-md ">
  <div class="container pt-4">
  
  <table class="table w-auto">
  
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
     $keyword = $_POST['searchbar'];

        if(isset($keyword)){
        $result = $pdo->query("SELECT * FROM `pieteikums` where telpa like '%$keyword%' or status like '%$keyword%' or iela like '%$keyword%' or problema  like '%$keyword%' or piezimes  like '%$keyword%' or epasts  like '%$keyword%' ORDER BY `pieteikums`.`laiks` DESC");
        }else
        $result = $pdo->query("SELECT * FROM pieteikums");
      $rows = $result->fetchAll();
    foreach ($rows as $row) {
      ?>
         <tr>
        <td>
        <div class="d-flex align-items-center">
          <div class="ms-6">
            <p class="fw-bold mb-1">Skolotāja Krutā</p>
            <p class="text-muted mb-1">coolteacher@gmail.com</p>
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
        <form method="post">
      <?php
        
          ?>
            
            <button type="button" class="btn btn-success btn-rounded">Apstiprināt</button>
            <button type="button" class="btn btn-danger btn-rounded">Izdzēst</button>
            <button type="button" class="btn btn-warning btn-rounded">Rediģēt</button>


        
         
         </form>
      </td>

    </tr>

  </tbody>
      


    <?php
    }


    ?>
    
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