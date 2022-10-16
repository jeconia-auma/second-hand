<?php include("partials/menu.php"); ?>

<div class="container">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php
            $id = $_GET['id'];
            //1. Get the details from database to fill in the form
            $sql = "SELECT * FROM category WHERE id=$id;";
            $res = mysqli_query($conn, $sql);
            
            //Test if executed successfully
            if($res == TRUE){
                $count = mysqli_num_rows($res);
                if($count == 1){
                    $row = mysqli_fetch_assoc($res);
                    $id = $row['id'];
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }else{
                    $_SESSION['update-category'] = "<div class='error'>Failed! Category Does not Exist</div>";
                    header("location:".SITEURL."admin/manage-category.php");
                }
            }else{
                $_SESSION['update-category'] = "<div class='error'>Failed to execute update query</div>";
                header("location:".SITEURL."admin/manage-category.php");
                die();
            }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-100">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                            if($current_image != ""){
                                ?>
                                    <img src="<?php echo '../images/category/'.$current_image;?>" width="150px">
                                <?php
                            }else{
                                ?>
                                    <div class="error">Image Not Available</div>
                                <?php
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" <?php if($featured == "yes") echo "checked"; ?> name="featured" value="yes">Yes
                        <input type="radio" <?php if($featured == "no") echo "checked"; ?> name="featured" value="no">No
                    </td>
                </tr>

                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" <?php if($active == "yes") echo "checked"; ?> name="active" value="yes">Yes
                        <input type="radio" <?php if($active == "no") echo "checked"; ?> name="active" value="no">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php

    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $title = strtoupper($_POST['title']);
        $image_names = $_FILES['image']['name'];
        $ext = strtolower(pathinfo($image_names, PATHINFO_EXTENSION));
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        //check if image is set or not and set value and upload;
        if($image_names != ""){
            $image_name = 'Book-Category-'.$title.'.'.$ext;
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = '../images/category/'.$image_name;

            //check if its really an image
            if($ext == "png"){
                //first delete the current image
                if($current_image != ""){
                    if(unlink("../images/category/".$current_image) == FALSE){
                        $_SESSION['update-category'] = "<div class='error'>Failed to Remove Current Image</div>";
                        header("location:".SITEURL."admin/manage-category.php");
                        die();
                    }
                }

                //if not empty then upload the image and check if uploaded successfully
                $upload = move_uploaded_file($source_path, $destination_path);

                if($upload == FALSE){
                    $_SESSION['update-category'] = "<div class='error'>Failed to Upload image</div>";
                    header("location:".SITEURL."admin/manage-category.php");
                    die();
                }
            }else{
                $_SESSION['update-category'] = "<div class='error'>Failed! File must be an image(.png)</div>";
                header("location:".SITEURL."admin/manage-category.php");
                die();
            }
        }else{
            $image_name = $current_image;
        }

        //Upload the image
        $sql2 = "UPDATE category SET
            title = '$title',
            image_name = '$image_name',
            featured = '$featured',
            active = '$active'
            WHERE id = $id;
        ";

        //Execute the query
        $res2 = mysqli_query($conn, $sql2);

        if($res2 == TRUE){
            $_SESSION['update-category'] = "<div class='success'>Category Updated Successfully</div>";
            header("location:".SITEURL."admin/manage-category.php");
        }else{
            $_SESSION['update-category'] = "<div class='error'>Failed to Update Category</div>".mysqli_error($conn);
            header("location:".SITEURL."admin/manage-category.php");
        }
    }

?>

<?php include("partials/footer.php"); ?>