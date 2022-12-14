<?php include('partials/menu.php'); ?>

<div class="container">
    <div class="wrapper">
        <h1>Manage Orders</h1>
        <br><br>
        <a href="<?php echo SITEURL; ?>admin/delivered-orders.php" class="btn-primary">View Delivered Orders</a>
        <?php
            if(isset($_SESSION['approved'])){
                echo $_SESSION['approved'];
                unset($_SESSION['approved']);
            }

            if(isset($_SESSION['delivered'])){
                echo $_SESSION['delivered'];
                unset($_SESSION['delivered']);
            }

            if(isset($_SESSION['denied'])){
                echo $_SESSION['denied'];
                unset($_SESSION['denied']);
            }
        ?>
        
        <table class="tbl-100">
            <tr>
                <th>S.N</th>
                <th>Book</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Amount</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
            <?php
                    //Get all the orders from database
                    $sql = "SELECT * FROM book_order WHERE purchase_status != 'delivered'";
                    $res = mysqli_query($conn, $sql);
                    //create serial number
                    $sn = 1;
                    if($res == TRUE){
                        $count = mysqli_num_rows($res);
                        if($count > 0){
                            while($row = mysqli_fetch_assoc($res)){
                                $order_id = $row['id'];
                                $user_id = $row['user_id'];
                                $book_id = $row['book_id'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $amount = $row['amount'];
                                $order_date = $row['order_date'];
                                $status = $row['purchase_status'];
                                
                                //get the user data
                                $sql1 = "SELECT * FROM users WHERE id=$user_id";
                                $res1 = mysqli_query($conn, $sql1);
                                if($res1 == TRUE){
                                    $row1 = mysqli_fetch_assoc($res1);
                                    $full_name = $row1['full_name'];
                                    $mobile = $row1['mobile'];
                                    $email = $row1['email'];
                                }
                                
                                //get the book data
                                $sql2 = "SELECT title FROM books WHERE id=$book_id";
                                $res2 = mysqli_query($conn, $sql2);
                                if($res2 == TRUE){
                                    $row2 = mysqli_fetch_assoc($res2);
                                    $title = $row2['title'];
                                }

                                //get the address
                                $sql3 = "SELECT * FROM users_addresses WHERE `user_id`=$user_id";
                                $res3 = mysqli_query($conn, $sql3);
                                if($res3 == TRUE){
                                    $row = mysqli_fetch_assoc($res3);
                                    $town = $row['town'];
                                    $district = $row['district'];
                                    $ward = $row['ward'];
                                    $other = $row['other_details'];
                                    $address = $town + ", " + $district + ", " + $ward + ", " + $other;
                                }
                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $qty; ?></td>
                                    <td><?php echo $amount; ?></td>
                                    <td><?php echo $order_date; ?></td>
                                    <?php
                                        if($status == 'ordered'){
                                            echo "<td class='error'>$status</td>";
                                        }elseif($status == 'approved'){
                                            echo "<td class='success'>$status</td>";
                                        }else{
                                            echo "<td class='error'>$status</td>";
                                        }
                                    ?>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $user_id; ?></td>
                                    <td><?php echo $email; ?></td>
                                    <td>Nairobi, Kwawangware, stage2 1200</td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/deny-order.php?id=<?php echo $order_id; ?>" class="btn-danger" title="Deny"><i class="fa-solid fa-xmark"></i></a>
                                        <a href="<?php echo SITEURL; ?>admin/approve-order.php?id=<?php echo $order_id; ?>" class="btn-secondary" title="Approve"><i class="fa-solid fa-check"></i></a>
                                        <a href="<?php echo SITEURL; ?>admin/deliver-book.php?id=<?php echo $order_id; ?>" class="btn-primary" title="Delivered" style="margin-top: 1px;"><i class="fa-solid fa-tags"></i></a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }else{
                            ?>
                                <td class='error'>No orderd or approved orders</td>
                            <?php
                        }
                    }
               ?> 
        </table>
    </div>
</div>
<script src="../js/app.js"></script>
<?php include('partials/footer.php'); ?>