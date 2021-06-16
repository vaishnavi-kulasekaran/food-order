<?php include('../partials/menu.php'); ?>

<?php  
        //1. get the id of selected admin
        $id = $_GET['id'];
        //2. create sql query to get details
        $sql = "SELECT * FROM tbl_food WHERE id=$id";
        //3. execute query
        $res = mysqli_query($conn,$sql);
        //check whether the query is executed or not 
        if($res==true)
        {
            //echo"data is available";
            $count = mysqli_num_rows($res);
            //check whether we have admin data or not 
            if($count==1)
            {
                //get the details
                //echo "Admin Available"; 
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $current_image = $row['image_name'];
                $current_category = $row['category_id'];
                $featured = $row['featured'];
                $active = $row['active'];
            }
            else
            {
                //redirect to manage-admin
                $_SESSION['food-not-found'] = "food not found";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
        }
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                     <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" width="5" cols="30"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                       <?php
                            if($current_image != "")
                            {
                                //display image
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="100px" >
                                <?php
                            }
                            else
                            {
                                echo "image not added";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                           <?php
                                $sql2 = "SELECT * FROM tbl_category WHERE active='Yes'"; 
                                $res2 = mysqli_query($conn, $sql2);
                                $count2 = mysqli_num_rows($res2);
                                if($count2>0)
                                {
                                    //category available
                                    while($row2=mysqli_fetch_assoc($res2))
                                    {
                                        $category_title = $row2['title'];
                                        $category_id = $row2['id'];
                                       // echo "<option value = '$category_id'>$category_title</option>";
                                        ?>
                                        <option value="<?php echo $category_id; ?>" <?php if($current_category == $category_id){ echo"selected"; } ?>><?php echo $category_title; ?></option>
                                        <?php
                                        
                                    } 
                                }
                                else
                                {
                                    echo "<option value = '0'>Category not available</option>";                                         
                                }
                           ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" <?php if($featured=="Yes"){echo "checked"; }?> name="featured" value="Yes"> Yes
                        <input type="radio" <?php if($featured=="No"){echo "checked";} ?> name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" <?php if($active=="Yes"){echo"checked";} ?> name="active" value="Yes"> Yes
                        <input type="radio" <?php if($active=="No"){echo"checked";} ?> name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?> ">
                        <input type="submit" name="submit" value="Update Food " class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            //check whether the admin button is clicked or not
            if(isset($_POST['submit']))
            {
                //echo "Button Clicked";
                //1.get all values from form to update
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_name = $_POST['current_image'];
                $category_id = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                
                //2.updating new image 
                if(isset($_FILES['image']['name']))
                    {
                        //upload the image
                        //to upload the image we need image name, source path and destination path
                        $image_name = $_FILES['image']['name'];
                        if($image_name!="")
                        {
                            //auto rename image
                            //get the extensionn of our image
                            $ext1 = explode('.',$image_name);
                            $ext = end($ext1);
                            //rename the image
                            $image_name = "Food_Name_".rand(000,999).'.'.$ext;
                            $source_path = $_FILES['image']['tmp_name'];
                            $destination_path = "../images/food/".$image_name;

                            //finally upload the image
                            $upload = move_uploaded_file($source_path, $destination_path);

                            //check whther the image is uploaded or not 
                            //and if the image is not uploaded and we will stop the procss and redirect with error message
                            if($upload==false)
                            {
                                $_SESSION['upload'] = "Failed to upload the image";
                                //redirect to add food page
                                header('location'.SITEURL.'admin/manage-food.php');
                                //stop the process
                                die();
                            }
                            if($current_image!="")
                            {
                                //remove the current image
                               $remove_path = "../images/food/".$current_image;
                               $remove = unlink($remove_path);
                               //check whether image remove or not 
                               //if failed to remove then display message and stop the process
                                if($remove==false)
                                {
                                    //failed to remove image
                                    $_SESSION['failed-remove'] = "Failed to Remove Current Image";
                                    header('location'.SITEURL.'admin/manage-food.php');
                                    die();
                                }
                            }
                        }
                        else
                        {
                            $image_name = $current_image;
                        }
                    }
                    else
                    {
                        //dont upload the image and set the image name value blank
                        $image_name= $current_image;
                    }
                
                //3.update database
                $sql1 = "UPDATE tbl_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = '$category_id',
                featured = '$featured',
                active = '$active'
                WHERE id = '$id'
                ";

                //Execute the query 
                $res1 = mysqli_query($conn, $sql1) or die(mysqli_error());

                //check whether the query is excuted
                if($res1==true)
                {
                    //Query excuted 
                    $_SESSION['update'] = "<div class='success'>Admin Updated Food</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    //failed to update
                    $_SESSION['update'] = "<div class='error'>Failed to update Food</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

            }

       ?>
    </div>
</div>

<?php include('../partials/footer.php'); ?>