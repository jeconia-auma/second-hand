<?php include("partials-front/menu.php"); ?>

<!--Beginning of Books Section-->
<div class="container">
    <div class="wrapper">
        <?php
            $category_id = $_GET['id'];
            $category_sql = "SELECT * FROM category WHERE id = $category_id";
            $category_res = mysqli_query($conn, $category_sql);
            if($category_res == TRUE){
                $category_row = mysqli_fetch_assoc($category_res);
                $category_name = $category_row['title'];
            }
        ?>
        <h1 class="text-center">Category: <?php echo $category_name; ?></h1>
        <div class="book">
            <?php
                //Get all the books from database
                //Qeury to get the data
                $sql2 = "SELECT * FROM books WHERE category_id = $category_id AND active='yes' LIMIT 8";
                //Execute the query
                $res2 = mysqli_query($conn, $sql2);
                if($res2 == TRUE){
                    //check if there is data in the database
                    $count2 = mysqli_num_rows($res2);
                    if($count2 > 0){
                        //display some of the books
                        while($row2 = mysqli_fetch_assoc($res2)){
                            $id = $row2['id'];
                            $title = $row2['title'];
                            $author = $row2['author'];
                            $description = $row2['description'];
                            $price = $row2['price'];
                            $image_name = $row2['image_name'];
                            $category_id = $row2['category_id'];
                            $featured = $row2['featured'];
                            $active = $row2['active'];
                            $total = $row2['total'];
                            ?>
                                <form action="cart.php" target="_blank" method="post">
                                    <div class="image">
                                        <img src="<?php echo SITEURL;?>images/books/<?php echo $image_name; ?>">
                                    </div>
                                    <div class="book-details">
                                        <h5>Title: <?php echo $title;?></h5>
                                        <h5>Author: <?php echo $author;?></h5>
                                        <p><?php echo $description;?></p>
                                        <input type="hidden" name="title" value="<?php echo $title;?>">
                                        <input type="hidden" name="author" value="<?php echo $author;?>">
                                        <input type="hidden" name="description" value="<?php echo $description;?>">
                                        <input type="hidden" name="price" value="<?php echo $price;?>">
                                        <input type="hidden" name="image_name" value="<?php echo $image_name;?>">
                                        <input type="hidden" name="category_id" value="<?php echo $category_id;?>">
                                        <input type="hidden" name="featured" value="<?php echo $featured;?>">
                                        <input type="hidden" name="active" value="<?php echo $active;?>">
                                        <input type="hidden" name="total" value="<?php echo $total;?>">
                                        <input type="hidden" name="book_id" value="<?php echo $id;?>">
                                        <input type="submit" value="Add to cart" class="btn-add-to-cart" name="submit">
                                    </div>
                                </form>
                            <?php
                        }
                    }else{
                        echo "<div class='error'>No books in database</div>";
                    }
                }else{
                    echo "<div class='error'>Failed to get books from database</div>";
                }
            ?>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!--End of Books Section-->


<?php include("partials-front/footer.php"); ?>