<?php
    session_start();
    $admin = array(
        'daniels.vidopskis@sk.lvt.lv',
        'arturs.aunins@lvt.lv',
        'gunta.lagzda@lvt.lv',
        'mareks.frismanis@sk.lvt.lv'
    );

    if(in_array($_SESSION['email'],$admin)){
        header("location:../Admin/panel.php");
    }else{
        header("location:../blocked.php");
    }
session_abort();



?>