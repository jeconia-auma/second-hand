<?php include("partials-front/menu.php"); ?>

<!--Beginning of Category Section-->
<div class="category">
    <div class="wrapper">
        <h1 class="text-center">Explore Books</h1>
        <?php
            $sql = "SELECT * FROM category WHERE active='yes'";
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
                                <a href="<?php echo SITEURL;?>books-category.php?id=<?php echo $id;?>">
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

<?php include("partials-front/footer.php"); ?>