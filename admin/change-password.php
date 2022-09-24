<?php include('partials/menu.php'); ?>
<div class="container">
    <div class="wrapper">
        <h1>Change Password</h1>

        <?php
            $id = $_GET['id'];
            if(isset($_SESSION['new_pass_error']))
        ?>

        <form action="" method="post">
            <table class="tbl-50">
                <tr>
                    <td>Current Password</td>
                    <td><input type="password" name="password" placeholder="Enter your Current Password"></td>
                </tr>

                <tr>
                    <td>New Password</td>
                    <td><input type="password" name="new_password" minlength="8" placeholder="Enter your New Password"></td>
                </tr>

                <tr>
                    <td>Confirm New Password</td>
                    <td><input type="password" name="confirm_password" minlength="8" placeholder="Confirm your Password"></td>
                </tr>

                <tr>
                    <td>
                        <input type="submit" value="Change Password" name="submit" minlength="8" class="btn-secondary">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('partials/footer.php'); ?>

<?php
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $password = md5($_POST['password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        if(!empty($password) && $new_password == $confirm_password){
            //Create Sql Query
            $sql = "SELECT * FROM users WHERE id=$id";
            //Execute the Sql Query
            $res = mysqli_query($conn, $sql);
    
            if($res == TRUE){
                $count = mysqli_num_rows($res);
                if($count == 1){
                    $row = mysqli_fetch_assoc($res);
                    $test_password = $row['password'];
                    if($password == $test_password){
                        $sql2 = "UPDATE users SET
                            password = '$new_password'
                            WHERE id = $id;
                        ";
                        
                        $res2 = mysqli_query($sql2);
                        if($res2 == TRUE){
                            $_SESSION['change-pass'] = "<div class='success'>Admin Password Changed Successfully</div>";
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }else{
                            $_SESSION['change-pass'] = "<div class='error'>Failed to change Admin Password</div>";
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                    }
                }
            }
        }
    }
?>