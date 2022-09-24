<?php
    include('../config/constants.php');

    //Get the Id and image_name and path
    $id = $_GET['id'];

    //Select from database to get the image name
    $sql = "SELECT * FROM category WHERE id='$id';";
    $res = mysqli_query($conn, $sql);

    if($res == TRUE){
        //check to see if there is data in the database
        $count = mysqli_num_rows($res);
        if($count == 1){
            $row = mysqli_fetch_assoc($res);
            if($image_name != ""){
                $image_name = "../images/category/".$row['image_name'];
                if(!unlink($image_name) == TRUE){
                    $_SESSION['del-category'] = "<div class='error'>Failed to delete image</div>";
                    header("location:".SITEURL."admin/manage-category.php");
                    die();
                }
            }else{
                $image_name = "";
            }
            
            //Create the query and execute if no error was produce above
            $sql2 = "DELETE FROM category WHERE id='$id'";
            $res2 = mysqli_query($conn, $sql2);
            //check if query executed successfully
            if($res2 == TRUE){
                $_SESSION['del-category'] = "<div class='success'>Deleted Successfully</div>";
                header("location:".SITEURL."admin/manage-category.php");
            }else{
                $_SESSION['del-category'] = "<div class='error'>Failed to delete image</div>";
                header("location:".SITEURL.'admin/manage-category.php');
            }
        }
    }
?>