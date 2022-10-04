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
</div>

<?php include("partials/footer.php"); ?>