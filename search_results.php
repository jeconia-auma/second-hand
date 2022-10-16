<?php include('partials-front/menu.php'); ?>

<?php
    //Get the search keyword
    $search_sentence = strtoupper(mysqli_real_escape_string($conn, htmlspecialchars($_POST['search'])));
?>

<div class="search">
    <div class="wrapper">
        <h1>Search For: <?php echo $search_sentence; ?></h1>
    </div>
</div>

<!--Category Section-->
<div class="category">
    <div class="wrapper">
    <?php
        if($search_sentence != ""){
            //Get data from database
            $sql1 = "SELECT * FROM category WHERE title LIKE '%$search_sentence' AND active='yes'";
            $res1 = mysqli_query($conn, $sql1);

            if($res1 == TRUE){
                $count1 = mysqli_num_rows($res1);
                if($count1 > 0){
                    //Data is in database
                    while($row1 = mysqli_fetch_assoc($res1)){
                        $id1 = $row1['id'];
                        $title1 = $row1['title'];
                        $image_name1 = $row1['image_name'];
                        ?>
                            <div class="category-items">
                                <a href="<?php echo SITEURL;?>books-category.php?id=<?php echo $id1;?>">
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name1; ?>" alt="">
                                    <div class="category-title text-center">
                                        <span><?php echo $title1; ?></span>
                                    </div>
                                </a>
                            </div>
                        <?php
                    }
                }
            }
        }
    ?>
    <div class="clearfix"></div>
    </div>
</div>
<!--End of Category Section-->

<!--Book Section-->
<div class="container">
    <div class="wrapper">
        <div class="book">
            <?php
                if($search_sentence != ""){
                    //Get all the books that correspond to the search sentence
                    $sql = "SELECT * FROM books WHERE title LIKE '%$search_sentence%' AND active='yes'";
                    $res = mysqli_query($conn, $sql);

                    if($res == TRUE){
                        //check to see if there is books
                        $count = mysqli_num_rows($res);
                        if($count > 0){
                            //print all the books found
                            while($row = mysqli_fetch_assoc($res)){
                                $id = $row['id'];
                                $title = $row['title'];
                                $author = $row['author'];
                                $description = $row['description'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $category_id = $row['category_id'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                $total = $row['total'];
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
                        }
                    }
                }else{
                    echo "<div class='error'>No Results Found</div>";
                }
            ?>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!--End of Book Section-->

<?php include('partials-front/footer.php'); ?>