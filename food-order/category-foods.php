<?php include('partials_front/menu.php'); ?>
<?php include("config/constants.php"); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php $title = $_GET['title']; ?>
            <?php $category_id = $_GET['category_id'];?>
            <h2>Foods on <a href="#" class="text-white">"<?php echo $title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                $sql = "SELECT * FROM tbl_food WHERE category_id='$category_id'";
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);
                if($count>0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                if($image_name=="")
                                {
                                  echo "Failed to load image";
                                }
                                else
                                {
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    <?php
                                }
                                 ?>   
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price"><?php echo $price; ?></p>
                                <p class="food-detail"><?php echo $description; ?></p>
                                <br>

                                <a href="order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        <?php
                    }
                }
            
            ?>
           <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials_front/footer.php'); ?>