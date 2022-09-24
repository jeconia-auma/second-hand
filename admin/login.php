<?php include('../config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../fonts/css/all.css">
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login-container">
        <form action="" method="post">
            <h1 class="text-center">Admin Login</h1>
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter your Email" required>
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter Your Password" required>
            <button type="submit" name="submit" class="btn-secondary">
                Login
            </button>
            <a href="#">Forgot Password</a>
        </form>
    </div>
</body>
</html>

<?php
    if(isset($_POST)){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email ='$email' and user_type='admin'";
        $res = mysqli_query($conn, $sql);

        if($res==TRUE){
            $count = mysqli_num_rows($res);
            if($count == 1){
                $row = mysqli_fetch_assoc($res);
                $_SESSION['user'] = $row['full_name'];
                header('location:'.SITEURL.'admin');
            }
        }
    }
?>