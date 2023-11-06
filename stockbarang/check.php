<?php
    //(Login) Jika belum login maka akan tetap berada di menu login
    if(isset($_SESSION['log'])){

    } else {
        header('location:login.php');
    }
?>
