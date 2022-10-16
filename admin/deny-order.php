<?php
    include("../config/constants.php");

    //Get the deliver id
    $id = $_GET['id'];

    //query to deliver
    $sql = "UPDATE book_order SET
        purchase_status = 'denied'
        WHERE id=$id
    ";

    $res = mysqli_query($conn, $sql);

    if($res == TRUE){
        $_SESSION['denied'] = "<div class='success'>Order Denied Successfully</div>";
        header("location:".SITEURL."admin/manage-orders.php");
    }else{
        $_SESSION['approved'] = "<div class='error'>Failed to Deny order</div>";
        header("location:".SITEURL."admin/manage-orders.php");
    }
?>