<?php include('partials/menu.php'); ?>
<div class="container">
    <div class="wrapper">
        <h1>Manage Books</h1>
        <br><br>
        <?php
            if(isset($_SESSION['add-book'])){
                echo $_SESSION['add-book'];
                unset($_SESSION['add-book']);
                echo "<br></br>";
            }
        ?>
        <a href="<?php echo SITEURL?>admin/add-book.php" class="btn-primary">Add Books</a>
        <br><br>

        <table class="tbl-100">
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Description</th>
                <th>price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php
                //get books data from database
                $sql = "SELECT * FROM books";

                //execute the query
                $res = mysqli_query($conn, $sql);

                if($res == TRUE){
                    if(mysqli_num_rows($res) > 0){
                        while($row = mysqli_fetch_assoc($res)){
                            $id = $row['id'];
                            $title  = $row['title'];
                            $description  = $row['description'];
                            $price  = $row['price'];
                            $image  = $row['image_name'];
                            $category  = $row['category_id'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            $total  = $row['total'];
                            ?>
                                <tr>
                                    <td><?php echo $id; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $description; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td>
                                        <img src="<?php echo SITEURL.'images/books/'.$image; ?>" width="100">
                                    </td>
                                    <td><?php echo $category; ?></td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td><?php echo $total; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL.'admin/update-book.php?id='.$id;?>" class="btn-secondary"><i class="fa-solid fa-pen-to-square"></i> Update</a>
                                        <a href="<?php echo SITEURL.'admin/update-book.php?id='.$id;?>" class="btn-danger"><i class="fa-solid fa-trash-can"></i> Delete</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    }
                }
            ?>
        </table>
    </div>
</div>
<?php include('partials/footer.php'); ?>