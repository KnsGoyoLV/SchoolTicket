<?php
    header("HTTP/1.1 403 Forbidden");
    echo "<!DOCTYPE html>";
    echo "<html>";
    echo "<head>";
    echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">';
    echo "</head>";
    echo "<body>";
    echo '<div class="container text-center">';
    echo '<h1 class="mt-5">Access Denied</h1>';
    echo '<p class="lead">You do not have permission to view this page.</p>';
  //  echo '<a href="login.php" class="btn btn-primary">Log In</a>';
    echo '</div>';
    echo "</body>";
    echo "</html>";   
?>