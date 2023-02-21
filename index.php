<?php
require "header.php";
?>
<br /><br />
<div class="pogaa">
  <button type="button" class="btn btn-success btn-rounded btn-lg float-right"><i class='fa fa-plus'
      style='color: white'><a href="pievienot.php"></i> Pievienot </button></a>
</div>
<table class="table align-middle mb-2 table-responsive">
  <thead class="thead-dark">
    <tr>
      <th>Iela un telpa/datums</th>
      <th>Problēma</th>
      <th>Piezīme</th>
      <th>Statuss</th>
      <th>IT/Saimniecības nodaļa</th>
      <th>Apstiprināt</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // get tickets that are made by the user and get all data about it 
    $result = $pdo->query("SELECT * FROM pieteikums WHERE epasts ='" . $_SESSION['email'] . "' ORDER BY `pieteikums`.`laiks` DESC");
    $rows = $result->fetchAll();
    foreach ($rows as $row) {
      ?>
      <tr>
        <td>
          <div class="d-flex align-items-center">
            <div class="ms-6">
              <p class="fw-bold mb-1">
                <?= $row['iela']; ?>:
                <?= $row['telpa']; ?>
              </p>
              <p class="text-muted mb-1">
                <?= $row['laiks']; ?>
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
          // Prints out ticket status in table and changes the color of it 
          if ($row['status'] == 'Atrisināts') {
            ?>
            <span class="badge badge-warning">
              <?= $row['status']; ?>
            </span>
            <?php
          } elseif ($row['status'] == 'Atrisināts(Parbaudīts)') {
            ?>
            <span class="badge badge-success">
              <?= $row['status']; ?>
            </span>
            <?php
          } else {
            ?>
            <span class="badge badge-info">
              <?= $row['status']; ?>
            </span>
            <?php
          }
          ?>
        </td>
        <td>
          <?= $row['nodala']; ?> nodaļa
        </td>
        <td>
          <form method="post">
            <?php
            if (isset($_POST['Done' . $row['ticket_id']])) {
              $pdo->query("UPDATE `pieteikums` SET `status` = 'Atrisināts(Parbaudīts)' WHERE ticket_id='" . $row['ticket_id'] . "'");
            }
            if (isset($_POST['Ndone' . $row['ticket_id']])) {
              $pdo->query("UPDATE `pieteikums` SET `status` = 'Neatrisināts' WHERE ticket_id='" . $row['ticket_id'] . "'");
            }

            if (isset($_POST['Done' . $row['ticket_id']]) || isset($_POST['Ndone' . $row['ticket_id']])) {
              echo ("<meta http-equiv='refresh' content='1'>");
            }
            if ($row['status'] == 'Atrisināts') {
              ?>
              <button name="Done<?= $row['ticket_id']; ?>" class="btn btn-link btn-sm btn-rounded">
                Izdarīts
              </button>
              <button name="Ndone<?= $row['ticket_id']; ?>" class="btn btn-link btn-sm btn-rounded">
                Neizdarīts
              </button>
              <?php
            } else {
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

<?php
require "footer.php";
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
  integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
  integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>