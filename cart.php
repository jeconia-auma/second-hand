<?php
    include('config/constants.php');

    if(isset($_POST['submit'])){
        $user_id = $_SESSION['customer'];
        $book_id = $_POST['book_id'];
        $price = $_POST['price'];
        $qty = 1;
        $amount = $price * $qty;
        
        //check if book already in cart
        $sql_test = "SELECT * FROM cart WHERE book_id = $book_id AND user_id = $user_id";
        $res_test = mysqli_query($conn, $sql_test);

        if($res_test ==  TRUE){
            if(mysqli_num_rows($res_test) > 0){
                $_SESSION['cart'] = "<script>alert('book already in cart');</script>";
            }else{
                //query to add the item to cart
                $sql = "INSERT INTO cart SET
                    `user_id` = $user_id,
                    book_id = $book_id,
                    price = $price,
                    qty = $qty,
                    amount = $amount
                ";
        
                $res = mysqli_query($conn, $sql);
        
                if($res == TRUE){
                    echo "done";
                    //header('location:'.SITEURL);
                    echo "<script>window.close('cart.php');</script>";
                }else{
                    echo "<script>alert('Book was not added to cart<script>');";
                    $_SESSION['cart'] = "<script>alert('failed book was not added');</script>";
                }
            }
        }else{
            echo "not true";
        }
    }
?>