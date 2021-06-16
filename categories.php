<?php include('partials_front/menu.php'); ?>
<?php include("config/constants.php"); ?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php 
            //create sql query to display categories
            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
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
                        <h3 class="float-text text-white text-center"><?php echo $title; ?></h3>
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


<?php include('partials_front/footer.php'); ?>  