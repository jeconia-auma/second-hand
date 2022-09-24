<?php 
    include('../config/constants.php');
    $id = $_GET['id'];
    
    $sql = "DELETE FROM users WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if($res == TRUE){
        $_SESSION['del-admin'] = "<div class='success'>Admin Deleted Successfully</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }else{
        $_SESSION['del-admin'] = "<div class='error'>Error Deleting Admin</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
?>
