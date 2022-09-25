<?php include('partials/menu.php'); ?>
<div class="container">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add-category'])){
                echo $_SESSION['add-category'];
                unset($_SESSION['add-category']);
                echo "<br><br>";
            }
            if(isset($_SESSION['del-category'])){
                echo $_SESSION['del-category'];
                unset($_SESSION['del-category']);
                echo "<br><br>";
            }
            if(isset($_SESSION['update-category'])){
                echo $_SESSION['update-category'];
                unset($_SESSION['update-category']);
                echo "<br><br>";
            }
        ?>

        <a href="<?php echo SITEURL.'admin/add-category.php'; ?>" class="btn-primary">Add Category</a>
        <table class="tbl-100">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
                //Sql query to select everything in the database
                $sql = "SELECT * FROM category;";
                //Execute the query
                $res = mysqli_query($conn, $sql);

                //check to see if there is anything in the database
                if($res == TRUE){
                    $count = mysqli_num_rows($res);
                    if($count > 0){
                        while($row = mysqli_fetch_assoc($res)){
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            ?>

                            <tr>
                                <td><?php echo $id;?></td>
                                <td><?php echo $title;?></td>
                                <td>
                                    <?php 
                                        if($image_name == ""){
                                            echo "<div class='error'>Image Not Available</div>";
                                        }else{
                                            ?>
                                                <img src="<?php echo SITEURL.'images/category/'.$image_name;?>" width="80px">
                                            <?php
                                        }
                                    ?>
                                </td>
                                <td><?php echo $featured;?></td>
                                <td><?php echo $active;?></td>
                                <td>
                                    <a href="<?php echo SITEURL.'admin/update-category.php?id='.$id;?>" class="btn-secondary">Update Category</a>
                                    <a href="<?php echo SITEURL.'admin/delete-category.php?id='.$id;?>" class="btn-danger">Delete Category</a>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                }
            ?>
        </table>
        <br><br>
    </div>
</div>

<?php include('partials/footer.php'); ?>