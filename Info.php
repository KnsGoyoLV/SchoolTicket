<?php
session_start();
require_once("database/connectDB.php");
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
</head>

<body>
    <header style="
    padding-bottom: 6px;">
        <nav class="navbar navbar-expand-lg bg-dark  navbar-dark py-3 fixed-top" style="bottom: 914px;">
            <div class="container">
                <a href="index.php" class="animate-charcter">Liepajas Valsts tehnikums</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse " id="navmenu">
                    <ul class="navbar-nav ms-auto  ">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link"><i class="fas fa-home"></i>Sākumlapa</a>
                        </li>
                        <li class="nav-item">
                            <a href="pievienot.php" class="nav-link"><i
                                    class="fas fa-plus"></i>Pievienot Pieteikumu</a>
                        </li>
                        <li class="nav-item">
                            <a href="#"style="background-color: #4782b5;" class="nav-link"><i class="fas fa-circle-info"></i>Informācija</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
                                id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
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
        <section class="vh-100" style="background-color: #eee;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-md-12 col-xl-4">

                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body text-center">
                                <div class="mt-3 mb-4">
                                    <img src="https://media.istockphoto.com/id/1273297997/vector/default-avatar-profile-icon-grey-photo-placeholder-hand-drawn-modern-man-avatar-profile-icon.jpg?s=612x612&w=0&k=20&c=n_K0uxMqCdHRxgeHYIQbzKebDeDMpY2TuqKsknTHcts="
                                        class="rounded-circle img-fluid" style="width: 100px;" />
                                </div>

                                <div class="header-fullname">
                                    <?= $_SESSION['username']; ?>
                                    <?= $_SESSION['surname']; ?>
                                </div>

                                <div class="header-information">
                                    Statuss:
                                    <?= $_SESSION['job']; ?>
                                </div>
                                <div class="jap">
                                    <div class="stats-title">E-pasts: </div>
                                    <div class="stats-value">
                                        <?= $_SESSION['email']; ?>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-between text-center mt-5 mb-2">
                                    <div>
                                        <p class="mb-2 h5">8471</p>
                                        <p class="text-muted mb-0">Mani pieteikumi</p>
                                    </div>
                                    <div class="px-3">
                                        <p class="mb-2 h5">8512</p>
                                        <p class="text-muted mb-0">Pabeigtie pieteikumi</p>
                                    </div>
                                    <div>
                                        <p class="mb-2 h5">4751</p>
                                        <p class="text-muted mb-0">Nepabeigtie pieteikumi</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <?php
        require "footer.php";
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

    </body>

</html>