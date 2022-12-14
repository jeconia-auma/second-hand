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
            if(isset($_SESSION['del-book'])){
                echo $_SESSION['del-book'];
                unset($_SESSION['del-book']);
                echo "<br></br>";
            }
            if(isset($_SESSION['update-book'])){
                echo $_SESSION['update-book'];
                unset($_SESSION['update-book']);
                echo "<br></br>";
            }
        ?>
        <a href="<?php echo SITEURL?>admin/add-book.php" class="btn-primary">Add Books</a>
        <br><br>

        <table class="tbl-100">
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Author</th>
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
                        //create serial number and innitialize to 1
                        $sn = 1;
                        while($row = mysqli_fetch_assoc($res)){
                            $id = $row['id'];
                            $title  = $row['title'];
                            $author = $row['author'];
                            $description  = $row['description'];
                            $price  = $row['price'];
                            $image  = $row['image_name'];
                            $category  = $row['category_id'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            $total  = $row['total'];
                            ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $author; ?></td>
                                    <td><?php echo $description; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td>
                                        <?php
                                            if($image != ""){
                                                ?>
                                                    <img src="<?php echo SITEURL.'images/books/'.$image; ?>" width="100">
                                                <?php
                                            }else{
                                                echo "<div class='error'>Image Not Available</div>";
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            //get the category name
                                            $sql3 = "SELECT * FROM category WHERE id=$category";
                                            $res3 = mysqli_query($conn, $sql3);
                                            if($res3 == TRUE){
                                                $count = mysqli_num_rows($res3);
                                                if($count == 1){
                                                    $row3 = mysqli_fetch_assoc($res3);
                                                    echo $row3['title'];
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td><?php echo $total; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL.'admin/update-book.php?id='.$id;?>" class="btn-secondary"><i class="fa-solid fa-pen-to-square" title="update"></i></a>
                                        <a href="<?php echo SITEURL.'admin/delete-book.php?id='.$id;?>" class="btn-danger"><i class="fa-solid fa-trash-can" title="delete"></i></a>
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