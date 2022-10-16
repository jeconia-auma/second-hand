<?php
    include("../config/constants.php");

    //Get the approve id
    $id = $_GET['id'];

    //query to approve
    $sql = "UPDATE book_order SET
        purchase_status = 'approved'
        WHERE id=$id
    ";

    $res = mysqli_query($conn, $sql);

    if($res == TRUE){
        $_SESSION['approved'] = "<div class='success'>Order Approved Successfully</div>";
        header("location:".SITEURL."admin/manage-orders.php");
    }else{
        $_SESSION['approved'] = "<div class='error'>Failed to approve order</div>";
        header("location:".SITEURL."admin/manage-orders.php");
    }
?>