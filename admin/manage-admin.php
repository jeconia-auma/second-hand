<?php include('partials/menu.php'); ?>
<div class="container">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br><br>

        <?php 
            if(isset($_SESSION['add-admin'])){
                echo $_SESSION['add-admin'];
                unset($_SESSION['add-admin']);
                echo "<br><br>";
            }
            if(isset($_SESSION['update-admin'])){
                echo $_SESSION['update-admin'];
                unset($_SESSION['update-admin']);
                echo "<br><br>";
            }
            if(isset($_SESSION['del-admin'])){
                echo $_SESSION['del-admin'];
                unset($_SESSION['del-admin']);
                echo "<br><br>";
            }
            if(isset($_SESSION['change-pass'])){
                echo $_SESSION['change-pass'];
                unset($_SESSION['change-pass']);
                echo "<br><br>";
            }
        ?>

        <a href="<?php echo SITEURL.'admin/add-admin.php'; ?>" class="btn-primary">Add Admin</a>
        <br><br>
        
        <table class="tbl-100">
            <th>S.N.</th>
            <th>Full Name</th>
            <th>email</th>
            <th>Action</th>

            <?php
                $sql = "SELECT * FROM users";
                $res = mysqli_query($conn, $sql);

                if($res == TRUE){
                    $count = mysqli_num_rows($res);
                    if($count > 0){
                        while($row = mysqli_fetch_assoc($res)){
                            //display the values in our table
                            $id = $row['id'];
                            $full_name = $row['full_name'];
                            $email = $row['email'];
                            
                            ?>
                            
                            <tr>
                                <td><?php echo $id;?></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $email;?></td>
                                <td>
                                    <a href="<?php echo SITEURL.'admin/update-admin.php?id='.$id; ?>" class="btn-secondary">Update Admin</a>
                                    <a href="<?php echo SITEURL.'admin/delete-admin.php?id='.$id; ?>" class="btn-danger">Delete Admin</a>
                                    <a href="<?php echo SITEURL.'admin/change-password.php?id='.$id; ?>" class="btn-primary">Change Password</a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                }
            ?>

        </table>
    </div>
</div>
<?php include('partials/footer.php'); ?>