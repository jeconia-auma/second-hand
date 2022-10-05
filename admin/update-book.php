<?php include("partials/menu.php"); ?>

<div class="container">
    <div class="wrapper">
        <h1>Update Books</h1>
        <br><br>

        <?php
            $id = $_GET['id'];
            //Get data from database
            $sql1 = "SELECT * FROM books WHERE id=$id";
            $res1 = mysqli_query($conn, $sql1);

            if($res1 == TRUE){
                $count = mysqli_num_rows($res1);
                if($count == 1){
                    $row = mysqli_fetch_assoc($res1);
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $current_image = $row['image_name'];
                    $current_category = $row['category_id'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    $total = $row['total'];
                }else{
                    $_SESSION['update-book'] = "<div class='error'>Failed! Book Does not Exist</div>";
                    header("location:".SITEURL."admin/manage-books.php");
                }
            }else{
                $_SESSION['update-book'] = "<div class='error'>Failed to update book</div>";
                header("location:".SITEURL."admin/manage-books.php");
                die();
            }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-100">
                <tr>
                    <td>Book Title</td>
                    <td>
                        <input type="text" name="title" required value="<?php echo $title;?>">
                    </td>
                </tr>
                <tr>
                    <td>Book Description</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Book Price</td>
                    <td>
                        <input type="number" name="price" required min="0" value="<?php echo $price;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image</td>
                    <td>
                    <?php
                            if($current_image != ""){
                                ?>
                                    <img src="<?php echo '../images/books/'.$current_image;?>" width="150px">
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
                    <td>Category</td>
                    <td>
                        <select name="category">
                            <?php
                                //get the category name and id
                                $sql = "SELECT * FROM category WHERE active='yes'";
                                $res = mysqli_query($conn, $sql);
                                if($res == TRUE){
                                    if(mysqli_num_rows($res) > 0){
                                        while($row = mysqli_fetch_assoc($res)){
                                            $category_id = $row['id'];
                                            $title = $row['title'];
                                            ?>
                                                <option <?php if($current_category == $category_id) echo "selected"; ?> value="<?php echo $category_id; ?>"><?php echo $title; ?></option>
                                            <?php
                                        }
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" value="yes" <?php if($featured == 'yes'){ echo "checked"; } ?>> Yes
                        <input type="radio" name="featured" value="no" <?php if($featured == 'no'){ echo "checked"; } ?>> No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" value="yes" <?php if($active == 'yes'){ echo "checked"; } ?>> Yes
                        <input type="radio" name="active" value="no" <?php if($active == 'no'){ echo "checked"; } ?>> No
                    </td>
                </tr>
                <tr>
                    <td>Stock Available</td>
                    <td>
                        <input type="number" name="total" min="0" value="<?php echo $total; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit" value="Update Book" class="btn-primary">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <?php
        if(isset($_POST['submit'])){
            //1. Get the form data
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $image_names = $_FILES['image']['name'];
            $ext = strtolower(pathinfo($image_names, PATHINFO_EXTENSION));
            $category = $_POST['category'];

            //set default value of featured if not set
            if(isset($_POST['featured'])){
                $featured = $_POST['featured'];
            }else{
                $featured = "no";
            }

            //set default value of active if not set
            if(isset($_POST['active'])){
                $active = $_POST['active'];
            }else{
                $active = "no";
            }

            //2. Store the data in the database
            //check if image is set or not and set value and upload;
            if($image_names != ""){
                $image_name = 'Book-'.$title.'.'.$ext;
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = '../images/books/'.$image_name;

                //check if its really an image
                if($ext == "jpg" || $ext == "png" || $ext == "jpeg"){
                    //first delete the current image
                    if($current_image != ""){
                        if(unlink("../images/books/".$current_image) == FALSE){
                            $_SESSION['update-book'] = "<div class='error'>Failed to Remove Current Image</div>";
                            header("location:".SITEURL."admin/manage-books.php");
                            die();
                        }
                    }

                    //if not empty then upload the image and check if uploaded successfully
                    $upload = move_uploaded_file($source_path, $destination_path);

                    if($upload == FALSE){
                        $_SESSION['update-book'] = "<div class='error'>Failed to Upload image</div>";
                        header("location:".SITEURL."admin/manage-books.php");
                        die();
                    }
                }else{
                    $_SESSION['update-book'] = "<div class='error'>Failed! File must be an image(.jpg, .png, .jpeg)</div>";
                    header("location:".SITEURL."admin/manage-category.php");
                    die();
                }
            }else{
                $image_name = $current_image;
            }
            //finally store the data in database

            $sql2 = "UPDATE books SET
                title = '$title',
                `description` = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active',
                total = $total
                WHERE id=$id
            ";

            //execute the query
            $res2 = mysqli_query($conn, $sql2);
            
            if($res2 == TRUE){
                $_SESSION['update-book'] = "<div class='success'>Book Updated Successfully</div>";
                header("location:".SITEURL."admin/manage-books.php");
            }else{
                $_SESSION['update-book'] = "<div class='error'>Failed to Update Book</div>".mysqli_error($conn);
                header("location:".SITEURL."admin/manage-books.php");
            }
        }
    ?>
</div>

<?php include("partials/footer.php"); ?>