<?php include('partials/menu.php'); ?>

<?php
    $id = $_GET['id'];
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
        <h1>Update Admin</h1>
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
                    <td><input type="submit" name="submit" value="Update Admin" class="btn-secondary"></td>
                    <input type="hidden" name="id" value="<?php echo $id?>">
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('partials/footer.php'); ?>

<?php
    if(isset($_POST['submit'])){
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
            $_SESSION['update-admin'] = "<div class='success'>Admin Updated Successfully</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else{
            $_SESSION['update-admin'] = "<div class='error'>Failed to Update Admin</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
?>