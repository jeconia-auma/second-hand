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
        <?php
            if(isset($_SESSION['no-address'])){
                echo "<br><br>";
                echo $_SESSION['no-address'];
                unset($_SESSION['no-address']);
                echo "<br><br>";
            }
        ?>
        <!--Update Details Section-->
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
        <!--End of Update Details Section-->

        <!--Address Details Section-->
        <fieldset>
            <?php
                //get the address details
                $user_id = $id;
                $address_sql = "SELECT * FROM `users_addresses` WHERE user_id=$user_id";
                $address_res = mysqli_query($conn, $address_sql);

                if($address_res == TRUE){
                    $address_count = mysqli_num_rows($address_res);
                    if($address_count == 1){
                        $address_row = mysqli_fetch_assoc($address_res);
                        $address_id = $address_row['id'];
                        $country = $address_row['country'];
                        $town = $address_row['town'];
                        $district = $address_row['district'];
                        $ward = $address_row['ward'];
                        $other = $address_row['other_details'];
                    }
                }
            ?>
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
                        <td><input type="text" name="country" value="<?php echo $country?>" required></td>
                    </tr>
    
                    <tr>
                        <td>Town</td>
                        <td><input type="text" name="town" value="<?php echo $town?>" required></td>
                    </tr>
                    
                    <tr>
                        <td>District</td>
                        <td><input type="text" name="district" value="<?php echo $district?>" required></td>
                    </tr>
    
                    <tr>
                        <td>Ward</td>
                        <td><input type="text" name="ward" value="<?php echo $ward?>" required></td>
                    </tr>

                    <tr>
                        <td>Other</td>
                        <td><textarea name="other" cols="30" rows="5" required><?php echo $other; ?></textarea></td>
                    </tr>
    
                    <tr>
                        <input type="hidden" name="user_id" value="<?php echo $id?>">
                        <td><input type="hidden" name="address_id" value="<?php echo $address_id; ?>"></td>
                        <td><input type="submit" name="submit_address" value="Update address" class="btn-secondary"></td>
                    </tr>
                </table>
            </form>
        </fieldset>
        <!--End of Address Details Section-->
        
        <!--Change Password Section-->
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
        <!--Change Password Section-->

    </div>
</div>
<?php include('partials-front/footer.php'); ?>

<?php
    //start of update user details section
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
            $_SESSION['update-user'] = "<div class='success'>User Updated Successfully</div>";
            ?>
                <script>window.location.replace("profile.php");</script>
            <?php
        }
        else{
            $_SESSION['update-user'] = "<div class='error'>Failed to Update User</div>";
            ?>
                <script>window.location.replace("profile.php");</script>
            <?php
        }
    }
    //End of user update details section



    //change password section
    if(isset($_POST['submit_password'])){
        $id = $_POST['id'];
        $password = md5($_POST['password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);
        
        //check to see if the current password is correct first
        $test_pass = "SELECT * FROM users WHERE id=$id AND password='$password'";
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
    //End of change password Section


    
    //Add or Update address
    if(isset($_POST['submit_address'])){
        $user_id = $_POST['user_id'];
        $address_id = $_POST['address_id'];
        $country = htmlspecialchars($_POST['country']);
        $town = htmlspecialchars($_POST['town']);
        $district = htmlspecialchars($_POST['district']);
        $ward = htmlspecialchars($_POST['ward']);
        $other = $_POST['other'];
        
        //if the address id is available in database
        if($_POST['address_id'] != ""){
            $sql3 = "UPDATE users_addresses SET
                user_id = $user_id,
                country = '$country',
                town = '$town',
                district = '$district',
                ward = '$ward',
                other_details = '$other'
                WHERE id=$address_id
            ";

            print_r($res3 = mysqli_query($conn, $sql3));
            if($res3 == TRUE){
                $_SESSION['update-address'] = "<div class='success'>Address Updated Successfully</div>";
                ?>
                    <script>window.location.replace("profile.php");</script>
                <?php
            }else{
                $_SESSION['update-address'] = "<div class='error'>Failed to Update Address</div>".mysqli_error($conn);
                ?>
                    <script>window.location.replace("profile.php");</script>
                <?php
            }
        }else{
            $sql4 = "INSERT INTO users_addresses SET
                user_id = $user_id,
                country = '$country',
                town = '$town',
                district = '$district',
                ward = '$ward',
                other_details = '$other'
            ";

            $res4 = mysqli_query($conn, $sql4);
            if($res4 == TRUE){
                $_SESSION['update-address'] = "<div class='success'>Address Added Successfully</div>";
                ?>
                    <script>window.location.replace("profile.php");</script>
                <?php
            }else{
                $_SESSION['update-address'] = "<div class='error'>Failed to add Address</div>".mysqli_error($conn);
                ?>
                    <script>window.location.replace("profile.php");</script>
                <?php
            }
        }
    }
?>
<!--End of Add or Update Address Section-->