<?php include("partials/menu.php"); ?>

<div class="container">
    <div class="wrapper">
        <h1>Add Books</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-100">
                <tr>
                    <td>Book Title</td>
                    <td>
                        <input type="text" name="title" required>
                    </td>
                </tr>
                <tr>
                    <td>Book Description</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Book Price</td>
                    <td>
                        <input type="number" name="price" required min="0">
                    </td>
                </tr>
                <tr>
                    <td>Book Image</td>
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
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            ?>
                                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
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
                        <input type="radio" name="featured" value="yes"> Yes
                        <input type="radio" name="featured" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" value="yes"> Yes
                        <input type="radio" name="active" value="no"> No
                    </td>
                </tr>
                <tr>
                    <td>Stock Available</td>
                    <td>
                        <input type="number" name="total" min="0">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="submit" value="Add Book" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    //check is submitted
    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category_id = $_POST['category'];
        $total_count = $_POST['total'];
        $image_names = $_FILES['image']['name'];
        $ext = strtolower(pathinfo($image_names, PATHINFO_EXTENSION));
        
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

        //upload first then add data to database
        //check if image is not empty
        if($image_names != ""){
            $image_name = 'Book-'.$title.'.'.$ext;
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = '../images/books/'.$image_name;
            
            //check if its really an image
            if($ext == "jpg" || $ext == "png" || $ext == "jpeg"){
                //if not empty then upload the image and check if uploaded successfully
                $upload = move_uploaded_file($source_path, $destination_path);

                if($upload == FALSE){
                    $_SESSION['add-book'] = "<div class='error'>Failed to Upload image</div>";
                    header("location:".SITEURL."admin/manage-books.php");
                    die();
                }
            }else{
                $_SESSION['add-book'] = "<div class='error'>Failed! File must be an image(.jpg, .png, .jpeg)</div>";
                header("location:".SITEURL."admin/manage-books.php");
                die();
            }
        }else{
            $image_name = "";
        }

        //create the query
        $sql2 = "INSERT INTO books SET
            title = '$title',
            `description` = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = '$category_id',
            featured = '$featured',
            active = '$active',
            total = $total_count
        ";

        //Execute the query
        $res2 = mysqli_query($conn, $sql2);
        
        //check if executed successfully
        if($res2 == TRUE){
            $_SESSION['add-book'] = "<div class='success'>Book Added Successfully</div>";
            header('location:'.SITEURL.'admin/manage-books.php');
        }else{
            $_SESSION['add-book'] = "<div class='error'>Failed to add Book</div>".mysqli_error($conn);
            header('location:'.SITEURL.'admin/manage-books.php');
        }
    }
?>

<?php include("partials/footer.php"); ?>