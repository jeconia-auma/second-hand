<?php
    include("config/constants.php");
    //For updating the books
    //Get all the contents of the form
    if(isset($_POST['submit'])){
        $book_id = $_POST['book_id'];
        $price = $_POST['price'];
        $qty = $_POST['quantity'];
        $cart_id = $_POST['cart_id'];
        $amount = $price * $qty;

        $sql = "UPDATE cart SET
            qty = $qty,
            amount = $amount
            WHERE id=$cart_id
        ";

        $res = mysqli_query($conn, $sql);

        if($res == TRUE){
            $_SESSION['update-cart'] = "<script>alert('Item Updated Successfully')</script>";
            header('location:'.SITEURL.'checkout.php');
        }else{
            $_SESSION['update-cart'] = "<script>alert('Failed to update the item')</script>";
            header('location:'.SITEURL.'checkout.php');
        }
    }

    //For deleting the books in the cart
    if(isset($_POST['remove'])){
        $cart_id = $_POST['cart_id'];

        $sql = "DELETE FROM cart WHERE id=$cart_id";
        $res = mysqli_query($conn, $sql);

        //check if deleted successfully
        if($res == TRUE){
            $_SESSION['remove-cart'] = "<script>alert('Item Removed Successfully')</script>";
            header('location:'.SITEURL.'checkout.php');
        }else{
            $_SESSION['remove-cart'] = "<script>alert('Failed to remove')</script>";
            header('location:'.SITEURL.'checkout.php');
        }
    }
?>