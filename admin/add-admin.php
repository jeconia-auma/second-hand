<?php include('partials/menu.php'); ?>
<div class="container">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <form action="" method="post">
            <table class="tbl-50">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="fullname" placeholder="Enter Full Name"></td>
                </tr>

                <tr>
                    <td>National Id</td>
                    <td><input type="number" name="national_id" placeholder="Enter your National Id"></td>
                </tr>

                <tr>
                    <td>Mobile Number</td>
                    <td><input type="tel" name="mobile" placeholder="Enter your Mobile Number"></td>
                </tr>

                <tr>
                    <td>Email</td>
                    <td><input type="email" name="email" placeholder="Enter your Email"></td>
                </tr>

                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" minlength="8" placeholder="Enter your Password"></td>
                </tr>
                
                <tr>
                    <td>Confirm Password</td>
                    <td>
                        <input type="password" name="confirm_password" minlength="8" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <button type="submit" name="submit" class="btn-secondary">Add Admin</button>
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>
<?php include('partials/footer.php'); ?>

<?php
    if(isset($_POST['submit'])){
        $full_name = $_POST['fullname'];
        $national_id = $_POST['national_id'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $confirm_password = md5($_POST['confirm_password']);

        if($password == $confirm_password){
            $sql = "INSERT INTO users SET
            full_name = '$full_name',
            national_id = '$national_id',
            mobile = '$mobile',
            email = '$email',
            password = '$password',
            user_type = 'admin';
            ";

            $res = mysqli_query($conn, $sql);

            if($res == TRUE){
                $_SESSION['add-admin'] = "<div class='success'>Admin added Successfully</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
            else{
                $_SESSION['add-admin'] = "<div class='error'>Failed to add Admin </div>".mysqli_error($conn);
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }

    }
?>