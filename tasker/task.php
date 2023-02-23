<?php
include("../functions/function.php");
require "../vendor/autoload.php";
MicrosoftInfo();
Invalid_seasson($_SESSION['email']);
block_domain();
include("..\database\connectDB.php");
?>
<!DOCTYPE html>
<html lang="lv">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LVT TicketSupport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="../Admin/style.css">
</head>

<body>
    <!--Main Navigation-->
    <header>
        <!-- Navbar -->
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-gray fixed-top">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <!-- Brand -->
                <a class="navbar-brand" href="#">
                    <a href="../index.php" class="animate-charcter">Liepajas Valsts tehnikums </a>
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
            $result = $pdo->query("SELECT * FROM pieteikums where telpa like '%$keyword%' or status like '%$keyword%' or iela like '%$keyword%' or problema  like '%$keyword%' or piezimes  like '%$keyword%' or epasts  like '%$keyword%' and nodala = 'Saimniecības' ORDER BY `pieteikums`.`laiks` DESC");
        } else {
            $result = $pdo->query("SELECT * FROM pieteikums where nodala = 'Saimniecības' and not status = 'Atrisināts(Parbaudīts)' ORDER BY `pieteikums`.`laiks` DESC");
        }
        $rows = $result->fetchAll();
        ?>
        <div class="container pt-4 ">
            <div class="table-responsive-md">
                <table class="mw-100" alt="Max-width 100%">
                    <thead class="thead-dark">
                        <tr>
                            <th class="th-sm">Skolotajs</th>
                            <th class="th-sm">Iela un telpa/datums</th>
                            <th class="th-sm">Problēma</th>
                            <th class="th-sm">Piezīme</th>
                            <th class="th-sm">Statuss</th>
                            <th class="th-sm">Rediģēt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
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
                                    } elseif ($row['status'] == 'Neatrisināts') {
                                        ?>
                                        <span class="badge badge-outline-red">
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
                                    <?php
                                    // change tickets status to complete
                                    if (isset($_POST['complete' . $row['ticket_id']])) {
                                        $pdo->query("UPDATE pieteikums SET status='Atrisināts' WHERE ticket_id='" . $row['ticket_id'] . "'");
                                    }
                                    //delete ticket from the database
                                    if (isset($_POST['NDone' . $row['ticket_id']])) {
                                        $pdo->query("UPDATE pieteikums SET status='Neatrisināts' WHERE ticket_id='" . $row['ticket_id'] . "'");
                                    }
                                    //update tickets info 
                                    if (isset($_POST['Proc' . $row['ticket_id']])) {
                                        $pdo->query("UPDATE pieteikums SET status='Procesā' WHERE ticket_id='" . $row['ticket_id'] . "'");
                                    }
                                    //simple refresh after the button has been pressed and the function above completed
                                    if (isset($_POST['NDone' . $row['ticket_id']]) || isset($_POST['complete' . $row['ticket_id']]) || isset($_POST['Proc' . $row['ticket_id']])) {
                                        echo ("<meta http-equiv='refresh' content='1'>");
                                    }
                                    ?>
                                    <form method="post">
                                        <button type="submit" class="btn btn-success btn-rounded"
                                            name="complete<?= $row['ticket_id']; ?>" value=<?= $row['ticket_id']; ?>>Apstiprināt</button>
                                        <button type="submit" name="NDone<?= $row['ticket_id']; ?>"
                                            class="btn btn-danger btn-rounded">Neizdarīts</button>
                                        <button type="submit" name="Proc<?= $row['ticket_id']; ?>"
                                            class="btn btn-warning btn-rounded ">Iesāks</button>

                                        <div class="modal fade" id="delete<?= $row['ticket_id']; ?>"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Apstiprinājums</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Vai tiešām vēlaties dzēst ierakstu?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Nē</button>
                                                        <button type="submit" name="delete1<?= $row['ticket_id']; ?>"
                                                            class="btn btn-primary">Jā</button>
                                                    </div>
                                                </div>
                                            </div>
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



</body>

</html>