<?php include('partials_front/menu.php'); ?>
<?php include("config/constants.php"); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
<?php
                if(isset($_SESSION['order']))
                {
                    echo $_SESSION['order'];
                    unset($_SESSION['order']); //removing session
                }
    ?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php 
            //create sql query to display categories
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            //execute query
            $res = mysqli_query($conn, $sql);
            //count rows whther the category is available or not
            $count = mysqli_num_rows($res);
            
            if($count>0)
            {
                //categories available
                while($row=mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                    
                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id ?>&title=<?php echo $title; ?>">
                    <div class="box-3 float-container">
                       <?php 
                        if($image_name=="")
                        {
                            echo"<div class='error'>Image not Available</div>";
                        }
                        else
                        {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve" width="350px" height="350px">
                            <?php
                        }
                        ?>
                       
                       <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                    </a>
                            
                    <?php
                }
            }
            else
            {
                //categories not available
                echo "</div class='error'>Category not Added</div>";
            }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
            //getting  foods from database
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
            //execute query
            $res2 = mysqli_query($conn, $sql2);
            //count rows whther the category is available or not
            $count2 = mysqli_num_rows($res2);
            
            if($count2>0)
            {
                //categories available
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $id1 = $row2['id'];
                    $title1 = $row2['title'];
                    $price1 = $row2['price'];
                    $description1 = $row2['description'];
                    $image_name1 = $row2['image_name'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                if($image_name1=="")
                                {
                                    echo"<div class='error'>Image not Available</div>";
                                }
                                else
                                {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name1; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve" width="100px" height="100px">
                                    <?php
                                }
                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title1; ?></h4>
                            <p class="food-price"><?php echo"Rs: ".$price1; ?></p>
                            <p class="food-detail"><?php echo $description1; ?></p>
                            <br>

                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id1; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                                
            <?php
                    }
            }
            ?>
            
            
            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->


<?php include('partials_front/footer.php'); ?>