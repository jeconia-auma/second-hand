<?php
    include("../config/constants.php");

    //Get the deliver id
    $id = $_GET['id'];
    $day = date("D");
    $date = (string) date("d");
    $month = MONTH[date("m")-1];
    $year = date("Y");
    echo $delivery_date = $day." ".$date." ".$month." ".$year;

    //query to deliver
    $sql = "UPDATE book_order SET
        purchase_status = 'delivered',
        delivery_date = '$delivery_date'
        WHERE id=$id
    ";

    $res = mysqli_query($conn, $sql);

    if($res == TRUE){
        $_SESSION['delivered'] = "<div class='success'>Order Delivered Successfully</div>";
        header("location:".SITEURL."admin/manage-orders.php");
    }else{
        $_SESSION['approved'] = "<div class='error'>Failed to Deliver order</div>";
        header("location:".SITEURL."admin/manage-orders.php");
    }
?>