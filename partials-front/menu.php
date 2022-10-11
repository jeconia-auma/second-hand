<?php
    include("config/constants.php");
    include('config/check-user-login.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Second Hand Books</title>
    <link rel="stylesheet" href="fonts/css/all.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/icons/logo3.png" type="image/x-icon">
</head>
<body>
    <div class="header text-center">
        <div class="wrapper">
            <!--Logo Starts Here-->
            <div class="logo">
                <img src="images/icons/logo2.png" alt="" width="100">
            </div>
            <!--Logo Ends Here-->

            <!--Menu Starts Here-->
            <div class="menu">
                <ul>
                    <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                    <li><a href="<?php echo SITEURL; ?>category.php">Categories</a></li>
                    <li><a href="<?php echo SITEURL; ?>books.php">Books</a></li>
                    <li><a href="<?php echo SITEURL; ?>contacts.php">Contacts</a></li>
                    <li><a href="<?php echo SITEURL; ?>cart.php"><i class="fa-solid fa-shopping-cart error"></i>
                        <?php
                            //Check for the cart items
                            $sql_cart = "SELECT * FROM cart where user_id = 12";
                            $res_cart = mysqli_query($conn, $sql_cart);

                            if($res_cart == TRUE){
                                //get the number
                                $count_cart = mysqli_num_rows($res_cart);
                                ?>
                                    <span class="error"><?php echo $count_cart;?></span>
                                <?php
                            }else{
                                //
                                echo "Database did not execute the query";
                            }
                        ?>
                    </a></li>
                </ul>
            </div>
            <!--Menu Ends Here-->

            <div class="clearfix"></div>
        </div>
    </div>