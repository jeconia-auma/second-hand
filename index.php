<?php include("partials-front/menu.php"); ?>

<?php include("partials-front/search.php");?>

<!--Beginning of Category Section-->
<div class="category">
    <div class="wrapper">
        <h1 class="text-center">Explore Books</h1>
        <?php
            $sql = "SELECT * FROM category WHERE featured='yes' AND active='yes' LIMIT 3";
            $res = mysqli_query($conn, $sql);

            if($res == TRUE){
                $count = mysqli_num_rows($res);
                if($count > 0){
                    //Data is in database
                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                            <div class="category-items">
                                <a href="">
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="">
                                    <div class="category-title text-center">
                                        <span><?php echo $title; ?></span>
                                    </div>
                                </a>
                            </div>
                        <?php
                    }
                }else{
                    echo "<div class='error text-center'>No Category Available</div>";
                }
            }
        ?>
        <div class="clearfix"></div>
    </div>
</div>
<!--End of Category Section-->

<!--Beginning of Books Section-->
<div class="container">
    <div class="wrapper">
        <h1 class="text-center">Buy Books</h1>
        <div class="book">
            <?php
                //Get all the books from database
                //Qeury to get the data
                $sql2 = "SELECT * FROM books WHERE featured='yes' AND active='yes' LIMIT 8";
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
                                <form action="" method="post">
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
                                        <input type="hidden" name="id" value="<?php echo $id;?>">
                                        <input type="submit" value="Add to cart" class="btn-add-to-cart">
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

<?php

?>

<?php include("partials-front/footer.php"); ?>