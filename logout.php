<?php
    include("config/check-user-login.php");
    include("config/constants.php");

    unset($_SESSION['customer']);
    header('location:'.SITEURL);
?>