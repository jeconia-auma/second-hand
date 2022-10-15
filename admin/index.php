<?php include("partials/menu.php"); ?>

<div class="container">
    <div class="wrapper">
        <h1>Dashboard</h1>
        <?php
            //Select distinct orders to display
        ?>
        <br>

        <!--Books Section-->
        <div class="shortcuts">
            <?php
                $sql1 = "SELECT * FROM books";
                $res1 = mysqli_query($conn, $sql1);
                if($res1 == TRUE){
                    $count1 = mysqli_num_rows($res1);
                }
            ?>
            <div class="head">
                <h4 class="text-center">Books</h4>
            </div>
            <div class="content">
                <h5 class="text-center">
                    <?php
                        if($count1 > 0){
                            echo $count1;
                        }else{
                            echo 0;
                        }
                    ?>
                </h5>
            </div>
        </div>

        <!--Category Section -->
        <div class="shortcuts">
            <?php
                $sql2 = "SELECT * FROM category";
                $res2 = mysqli_query($conn, $sql2);
                if($res2 == TRUE){
                    $count2 = mysqli_num_rows($res2);
                }
            ?>
            <div class="head">
                <h4 class="text-center">Categories</h4>
            </div>
            <div class="content">
                <h5 class="text-center">
                    <?php
                        if($count2 > 0){
                            echo $count2;
                        }else{
                            echo 0;
                        }
                    ?>
                </h5>
            </div>
        </div>

        <!--Orders Seciton-->
        <div class="shortcuts">
            <?php
                $sql3 = "SELECT * FROM book_order";
                $res3 = mysqli_query($conn, $sql3);
                if($res3 == TRUE){
                    $count3 = mysqli_num_rows($res3);
                }
            ?>
            <div class="head">
                <h4 class="text-center">Total Orders</h4>
            </div>
            <div class="content">
                <h5 class="text-center">
                    <?php
                        if($count3 > 0){
                            echo $count3;
                        }else{
                            echo 0;
                        }
                    ?>
                </h5>
            </div>
        </div>

        <!--Revenue Seciton-->
        <div id="revenue">
            <?php
                $sql4 = "SELECT * FROM book_order";
                $res4 = mysqli_query($conn, $sql4);
                $revenue = 0;
                if($res4 == TRUE){
                    $count4 = mysqli_num_rows($res4);
                    if($count4 > 0){
                        while($row4 = mysqli_fetch_assoc($res4)){
                            //add the revenue;
                            $revenue += $row4['amount'];
                        }
                    }
                }
            ?>
            <div class="head">
                <h4 class="text-center">Revenues</h4>
            </div>
            <div class="content">
                <h5 class="text-center">KSH: 
                    <?php
                        if($revenue > 0){
                            echo money_format('%i', $revenue);
                        }else{
                            echo 0;
                        }
                    ?>
                </h5>
            </div>
        </div>
    </div>
</div>

<?php include("partials/footer.php"); ?>