<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="fonts/css/all.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
    <div class="login-container">
        <form action="" method="post">
            <h1 class="text-center">Signup</h1>
            <label>Full Name</label>
            <input type="text" name="full_name" placeholder="Enter your Name" required>
            <label>National Id</label>
            <input type="number" name="national_id" placeholder="Enter your National Id" min='10000' required>
            <label>Mobile</label>
            <input type="tel" name="mobile" placeholder="Enter your Mobile No." minlength='9' required>
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter your Email" required>
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter Your Password" minlength='8' required>
            <label>Confirm Password</label>
            <input type="password" name="conf_password" placeholder="Confirm Password" minlength='8' required>
            <button type="submit" name="submit" class="btn-secondary">
                Submit
            </button>
            <a href="#">Forgot Password</a>
        </form>
    </div>
</body>
</html>

<?php
    if(isset($_POST['submit'])){
        $full_name = $_POST['full_name'];
        $national_id = $_POST['national_id'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $conf_password = $_POST['conf_password'];

        $sql = "SELECT * FROM users WHERE mobile='$mobile' OR email ='$email' OR national_id = $national_id";
        $res = mysqli_query($conn, $sql);

        if($res==TRUE){
            $count = mysqli_num_rows($res);
            
            if($count > 0){
                $row = mysqli_fetch_assoc($res);
                if($national_id == $row['national_id']){
                    echo "<script>alert('Failed!! National Id already exist');</script>";
                }elseif($mobile == $row['mobile']){
                    echo "<script>alert('Failed!! Mobile already exist');</script>";
                }elseif($email == $row['email']){
                    echo "<script>alert('Failed!! Email already exist');</script>";
                }
            }else{
                if($password == $conf_password){
                    //Execute Query to add user
                    $sql2 = "INSERT INTO users SET
                        full_name = '$full_name',
                        national_id = $national_id,
                        mobile = '$mobile',
                        email = '$email',
                        password = '$password',
                        user_type = 'user'
                    ";
                    $res2 = mysqli_query($conn, $sql2);
                    if($res2 == TRUE){
                        echo "<script>alert('Welcome! Thank you for Sign Up');</script>";
                        $sql3 = "SELECT * FROM users where email = '$email'";
                        $res3 = mysqli_query($conn, $sql3);
                        if(mysqli_num_rows($res3) == 1){
                            $row3 = mysqli_fetch_assoc($res3);
                            $_SESSION['customer'] = $row3['id'];
                            header('location:'.SITEURL);
                        }
                    }else{
                        echo mysqli_error($conn);
                    }
                }else{
                    echo "<script>alert('Confirmation Password should be same as Password');</script>";
                }
            }
        }else{
            echo "Query not executed".mysqli_error($conn);
        }
    }
?>