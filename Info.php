<?php 
session_start();
require_once("database/connectDB.php");
if(!isset($_SESSION['t'])){
    header('location: login.php');
   }

require("header.php");
?>


  
<div class="container bootstrap snippets bootdey">
    <div class="col-md-12">
        <div class="profile-container">
            <div class="profile-header row">
                <div class="col-md-4 col-sm-12 text-center">
                    <img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="header-avatar">
                </div>
                <div class="col-md-8 col-sm-12 profile-info">
                    <div class="header-fullname"><?= $_SESSION['username'];?> <?= $_SESSION['surname'];?></div>
                    <div class="header-information">
                    Statuss:<?= $_SESSION['job'];?>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 profile-stats">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12 stats-col">
                            <div class="stats-value pink">1</div>
                            <div class="stats-title">Mani pieteikumi</div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 stats-col">
                            <div class="stats-value"><?= $_SESSION['email'];?></div>
                            <div class="stats-title">E-pasts</div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 stats-col">
                            <div class="stats-value pink">kko vel ja vaig</div>
                            <div class="stats-title">kko vel ja vaig</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4 inlinestats-col">
                            <i class="glyphicon glyphicon-map-marker"></i> Liepajas Valsts tehnikums
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 inlinestats-col">
                            nezinu: <strong>1</strong>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-4 inlinestats-col">
                            nezinu: <strong>2</strong>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>
</div>


<?php
require "footer.php";
?>


<script src="files/script.js"></script>
</body>
</html>