<?php include("partials-front/menu.php");?>

<?php
    if(isset($_SESSION['update-cart'])){
        echo $_SESSION['update-cart'];
        unset($_SESSION['update-cart']);
    }

    if(isset($_SESSION['remove-cart'])){
        echo $_SESSION['remove-cart'];
        unset($_SESSION['remove-cart']);
    }

    if(isset($_SESSION['book-order'])){
        echo $_SESSION['book-order'];
        unset($_SESSION['book-order']);
    }
?>

<div class="container">
    <div class="wrapper">
        <h1>Checkout</h1>
        <?php
            $user_id = $_SESSION['customer'];
            $sql = "SELECT * FROM cart WHERE user_id=$user_id";
            $res = mysqli_query($conn, $sql);
            
            if($res == TRUE){
                if(mysqli_num_rows($res) > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        //view all all of the books
                        $cart_id = $row['id'];
                        $user_id = $row['user_id'];
                        $book_id = $row['book_id'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $amount = $row['amount'];
                        ?>
                            <div class="book">
                                <form action="update-cart.php" method="post">
                                    <?php
                                        //get book details
                                        $book_details = "SELECT * FROM books WHERE id=$book_id";
                                        $book_res = mysqli_query($conn, $book_details);

                                        if($book_res == TRUE){
                                            if(mysqli_num_rows($book_res) == 1){
                                                $book_row = mysqli_fetch_assoc($book_res);

                                                $book_id = $book_row['id'];
                                                $book_title = $book_row['title'];
                                                $book_author = $book_row['author'];
                                                $book_image = $book_row['image_name'];
                                                $book_description = $book_row['description'];
                                            }else{
                                                echo "<div class='error'>No Book Found</div>";
                                            }
                                        }else{
                                            echo "<div class='error'>Failed to get books</div>";
                                        }
                                    ?>
                                    <div class="image">
                                        <img src="<?php echo SITEURL;?>images/books/<?php echo $book_image; ?>">
                                    </div>
                                    <div class="book-details">
                                        <h5>Title: <?php echo $book_title;?></h5>
                                        <h5>Author: <?php echo $book_author;?></h5>
                                        <p><?php echo $book_description;?></p>
                                        <input type="number" name="quantity" placeholder="Enter quantity" value="<?php echo $qty;?>">
                                        <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
                                        <input type="hidden" name="cart_id" value="<?php echo $cart_id; ?>">
                                        <input type="text" name="amount" value="<?php echo $amount; ?>" disabled>
                                        <input type="submit" value="Update" class="btn-add-to-cart" name="submit">
                                        <input type="submit" value="Remove" class="btn-danger" name="remove">
                                    </div>
                                </form>
                            </div>
                        <?php
                    }
                }else{
                    echo "<div class='error'>No Item in Cart</div>";
                }
            }else{
                echo "<div class='error'>Query was not Executed</div>";
            }
        ?>
        <form action="" method="post">
            <?php
                //check there is item in the checkout section
                $sql = "SELECT * FROM cart WHERE user_id=$user_id";
                $res = mysqli_query($conn, $sql);
                if($res == TRUE){
                    $count = mysqli_num_rows($res);
                    if($count > 0){
                        ?>
                            <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
                            <input type="hidden" name="date" id="order_date">
                            <input type="submit" name="checkout" value="Checkout" class="btn-secondary">
                        <?php
                    }else{
                        ?>
                            <input type="submit" name="checkout" value="Checkout" class="btn-secondary" disabled>
                        <?php
                    }
                }else{
                    ?>
                        <input type="submit" name="checkout" value="Checkout" class="btn-secondary" disabled>
                    <?php
                }
            ?>
        </form>

        <?php
            //checkout the items
            if(isset($_POST['checkout'])){
                //get the user Id and get the order date
                $user_id = $_POST['user_id'];
                $order_date = $_POST['date'];

                //get all the books from cart and post them
                while($row = mysqli_fetch_assoc($res)){
                    echo $cart_id = $row['id'];
                    $book_id = $row['book_id'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $amount = $row['amount'];

                    $sql2 = "INSERT INTO book_order SET
                        user_id = $user_id,
                        book_id = $book_id,
                        price = $price,
                        qty = $qty,
                        amount = $amount,
                        order_date = '$order_date',
                        delivery_date = '',
                        purchase_status = 'ordered'
                    ";

                    $res2 = mysqli_query($conn, $sql2);

                    if($res2 == TRUE){
                        //Remove books from cart
                        $sql3 = "DELETE FROM cart WHERE id = $cart_id";
                        $res3 = mysqli_query($conn, $sql3);

                        if($res3 == TRUE){
                            $_SESSION['book-order'] = "<script>alert('Book Ordered Successfully')</script>";
                            header('location:'.SITEURL.'checkout.php');
                        }else{
                            echo "<script>alert('Failed to order')</script>";
                        }
                    }else{
                        echo "<script>alert('Failed to order')</script>".mysqli_error($conn);
                    }
                }
            }
        ?>
    </div>
</div>

<script src="js/app.js"></script>

<?php include("partials-front/footer.php"); ?>