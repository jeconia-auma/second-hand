<?php include('partials/menu.php'); ?>

<div class="container">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-100">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" placeholder="Enter Category Title" required></td>
                </tr>

                <tr>
                    <td>Image Name</td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" value="yes">Yes
                        <input type="radio" name="featured" value="no">No
                    </td>
                </tr>

                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" value="yes">Yes
                        <input type="radio" name="active" value="no">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    if(isset($_POST['submit'])){
        $title = strtoupper($_POST['title']);
        $image_names = $_FILES['image']['name'];
        $ext = strtolower(pathinfo($image_names, PATHINFO_EXTENSION));
        
        //Check if featured and active are set if not assing no value to them
        if(!isset($_POST['featured'])){
            $featured = 'no';
        }else{
            $featured = $_POST['featured'];
        }
        if(!isset($_POST['active'])){
            $active = 'no';
        }else{
            $active = $_POST['active'];
        }
        
        //check to see if the title already exists
        $sql_test_title = "SELECT * FROM category WHERE title='$title'";
        $res_test = mysqli_query($conn, $sql_test_title);

        //check if the query executed successfully
        if($res_test == TRUE){
            echo $count = mysqli_num_rows($res_test);
            //check if the title already exist by getting the number of rows
            if($count > 0){
                $_SESSION['add-category'] = "<div class='error'>Failed! Title already exist</div>";
                header("location:".SITEURL."admin/manage-category.php");
                die();
                //else if not true
            }else{
                //check if image is set or not and set value;
                if($image_names != ""){
                    $image_name = 'Book-Category-'.$title.'.'.$ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = '../images/category/'.$image_name;

                    //check if its really an image
                    if($ext == "png"){
                        //if not empty then upload the image and check if uploaded successfully
                        $upload = move_uploaded_file($source_path, $destination_path);
    
                        if($upload == FALSE){
                            $_SESSION['add-category'] = "<div class='error'>Failed to Upload image</div>";
                            header("location:".SITEURL."admin/manage-category.php");
                            die();
                        }
                    }else{
                        $_SESSION['add-category'] = "<div class='error'>Failed! File must be an image(.png)</div>";
                        header("location:".SITEURL."admin/manage-category.php");
                        die();
                    }
                }else{
                    $image_name = "";
                }
                
                //If it passes the above test without error continue to adding category in database
                $sql = "INSERT INTO category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                ";
    
                //Execute the query above
                $res = mysqli_query($conn, $sql);
                //Check if it executed successfully
                if($res == TRUE){
                    $_SESSION['add-category'] = "<div class='success'>Category Added Successfully</div>";
                    header("location:".SITEURL."admin/manage-category.php");
                }else{
                    $_SESSION['add-category'] = "<div class='error'>Failed to add Category</div>";
                    header("location:".SITEURL."admin/manage-category.php");
                }
            }
        }
    }
    ?>

<?php include('partials/footer.php'); ?>