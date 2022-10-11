<?php
    if(!isset($_SESSION['customer'])){
        header('location:'.SITEURL.'login.php');
    }
?>