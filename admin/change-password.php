<?php include('partials/menu.php'); ?>
<div class="container">
    <div class="wrapper">
        <h1>Change Password</h1>

        <?php
            $id = $_GET['id'];
            if(isset($_SESSION['new_pass_error']))
            if(isset($_SESSION['change-pass'])){
                echo $_SESSION['change-pass'];
                unset($_SESSION['change-pass']);
            }
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
        
        //check to see if the current password is correct first
        $test_pass = "SELECT * FROM users WHERE id=$id AND `password`='$password'";
        $test_pass_res = mysqli_query($conn, $test_pass) or die(mysqli_error($conn));
        
        //check if the query above executed
        if($test_pass_res == TRUE){
            $count_test_pass = mysqli_num_rows($test_pass_res);
            if($count_test_pass == 1){
                if($new_password == $confirm_password){
                    //create query
                    $sql2 = "UPDATE users SET
                        password = '$new_password'
                        WHERE id = $id;
                    ";

                    $res2 = mysqli_query($conn, $sql2);
                    if($res2 == TRUE){
                        $_SESSION['change-pass'] = "<div class='success'>Password Changed Successfully</div>";
                        ?>
                            <script>window.location.replace("manage-admin.php");</script>
                        <?php
                    }
                }else{
                    $_SESSION['change-pass'] = "<div class='error'>Failed! New and Confirmation Password do not match</div>";
                    ?>
                        <script>window.location.replace("manage-admin.php");</script>
                    <?php
                }
            }else{
                $_SESSION['change-pass'] = "<div class='error'>Failed! Current Password is incorrect</div>";
                ?>
                    <script>window.location.replace("manage-admin.php");</script>
                <?php
            }
        }
    }
?>