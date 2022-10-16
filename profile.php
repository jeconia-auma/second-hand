<?php include('partials-front/menu.php'); ?>

<?php
    $id = $_SESSION['customer'];
    $sql = "SELECT * FROM users WHERE id=$id";
    //Execute the query
    $res = mysqli_query($conn, $sql);
    if($res == TRUE){
        $count = mysqli_num_rows($res);
        if($count == 1){
            $row = mysqli_fetch_assoc($res);
            $id = $row['id'];
            $full_name = $row['full_name'];
            $national_id = $row['national_id'];
            $mobile = $row['mobile'];
            $email = $row['email'];
        }
    }
?>

<div class="container">
    <div class="wrapper">
        <h1>Profile</h1>
        <fieldset>
            <legend>Update Details</legend>
            <?php
                if(isset($_SESSION['update-user'])){
                    echo $_SESSION['update-user'];
                    unset($_SESSION['update-user']);
                }
            ?>
            <form action="" method="post">
                <table class="tbl-50">
                    <tr>
                        <td>Full Name</td>
                        <td><input type="text" name="full_name" value="<?php echo $full_name?>"></td>
                    </tr>
    
                    <tr>
                        <td>National Id</td>
                        <td><input type="number" name="national_id" minlength="10" value="<?php echo $national_id?>"></td>
                    </tr>
                    
                    <tr>
                        <td>Mobile</td>
                        <td><input type="tel" name="mobile" minlength="10" value="<?php echo $mobile?>"></td>
                    </tr>
    
                    <tr>
                        <td>Email</td>
                        <td><input type="text" name="email" value="<?php echo $email?>"></td>
                    </tr>
    
                    <tr>
                        <td><input type="submit" name="update" value="Update Profile" class="btn-secondary"></td>
                        <input type="hidden" name="id" value="<?php echo $id?>">
                    </tr>
                </table>
            </form>
        </fieldset>

        <fieldset>
            <legend>Address</legend>
            <?php
                if(isset($_SESSION['update-address'])){
                    echo $_SESSION['update-address'];
                    unset($_SESSION['update-address']);
                }
            ?>
            <form action="" method="post">
                <table class="tbl-50">
                    <tr>
                        <td>Country</td>
                        <td><input type="text" name="full_name" value="<?php echo $full_name?>"></td>
                    </tr>
    
                    <tr>
                        <td>National Id</td>
                        <td><input type="number" name="national_id" minlength="10" value="<?php echo $national_id?>"></td>
                    </tr>
                    
                    <tr>
                        <td>Mobile</td>
                        <td><input type="tel" name="mobile" minlength="10" value="<?php echo $mobile?>"></td>
                    </tr>
    
                    <tr>
                        <td>Email</td>
                        <td><input type="text" name="email" value="<?php echo $email?>"></td>
                    </tr>
    
                    <tr>
                        <td><input type="submit" name="update" value="Update Profile" class="btn-secondary"></td>
                        <input type="hidden" name="id" value="<?php echo $id?>">
                    </tr>
                </table>
            </form>
        </fieldset>
        
        <fieldset>
            <?php
                if(isset($_SESSION['change-pass'])){
                    echo $_SESSION['change-pass'];
                    unset($_SESSION['change-pass']);
                }
            ?>
            <legend class='error'>Change Password</legend>
            <form action="" method="post">
                <table class="tbl-50">
                    <tr>
                        <td>Current Password</td>
                        <td><input type="password" name="password" placeholder="Enter your Current Password" required></td>
                    </tr>

                    <tr>
                        <td>New Password</td>
                        <td><input type="password" name="new_password" minlength="8" placeholder="Enter your New Password" required></td>
                    </tr>

                    <tr>
                        <td>Confirm New Password</td>
                        <td><input type="password" name="confirm_password" minlength="8" placeholder="Confirm your Password" required></td>
                    </tr>

                    <tr>
                        <td>
                            <input type="submit" value="Change Password" name="submit_password" minlength="8" class="btn-secondary">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                        </td>
                    </tr>
                </table>
            </form>
        </fieldset>

    </div>
</div>
<?php include('partials-front/footer.php'); ?>

<?php
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $national_id = $_POST['national_id'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];

        $sql = "UPDATE `users` SET
            full_name = '$full_name',
            national_id = '$national_id',
            mobile = '$mobile',
            email = '$email'
            WHERE id=$id;
        ";

        $res = mysqli_query($conn, $sql);

        if($res == TRUE){
            $_SESSION['update-user'] = "<div class='success'>Admin Updated Successfully</div>";
            ?>
                <script>window.location.replace("profile.php");</script>
            <?php
        }
        else{
            $_SESSION['update-user'] = "<div class='error'>Failed to Update Admin</div>";
            ?>
                <script>window.location.replace("profile.php");</script>
            <?php
        }
    }

    //change password section
    if(isset($_POST['submit_password'])){
        $id = $_POST['id'];
        $password = md5($_POST['password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);
        
        //check to see if the current password is correct first
        $test_pass = "SELECT * FROM users WHERE id=$id";
        $test_pass_res = mysqli_query($conn, $test_pass);
        
        //check if the query above executed
        if($test_pass_res == TRUE){
            echo $count_test_pass = mysqli_num_rows($test_pass_res);
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
                            <script>window.location.replace("profile.php");</script>
                        <?php
                    }
                }else{
                    $_SESSION['change-pass'] = "<div class='error'>Failed! New and Confirmation Password do not match</div>";
                    ?>
                        <script>window.location.replace("profile.php");</script>
                    <?php
                }
            }else{
                $_SESSION['change-pass'] = "<div class='error'>Failed! Current Password is incorrect</div>";
                ?>
                    <script>window.location.replace("profile.php");</script>
                <?php
            }
        }
    }
?>