<?php include('../partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
            <h1>Add Food</h1>
            <br><br>
            <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']); //removing session
                    }
                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']); //removing session
                    }
             ?>
            <!-- Add Category Form Starts Here -->
            <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="title of the food">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea  name="description" cols="30" rows="2" placeholder="Description of the food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" >
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select  name="category">
                            <?php 
                                //create php code to display categories from database
                                //1. create sql to get all active categories
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                //executing query
                                $res = mysqli_query($conn, $sql);
                                //count rows to check whether we have category or not
                                $count = mysqli_num_rows($res);
                                
                                //if count is greater than zero we have categories else we do not have categories
                                if($count>0)
                                {
                                    //we have categories
                                    while($row =mysqli_fetch_assoc($res))
                                    {
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    //we do not have categories
                                    ?>
                                    <option value="0">No category Found</option>
                                    <?php
                                }
                                
                                //2. Display on drop down 
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>                    
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>                    
                </tr>
            </table>   
            </form>
            <!-- Add Category Form Ends Here -->
            <?php
                //check whether the submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    //echo "Clicked";
                    //1. get the value from category form
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $category = $_POST['category'];
                    //for radio input button check whether the button is selected or not
                    if(isset($_POST['featured']))
                    {
                        //get the value from form
                        $featured = $_POST['featured'];
                    }
                    else
                    {
                        //set the default value
                        $featured = "No";
                    }
                    if(isset($_POST['active']))
                    {
                        //get the value from form
                        $active = $_POST['active'];
                    }
                    else
                    {
                        //set the default value
                        $active = "No";
                    }
                    //check whther the image is selected or not and set the value for image name accordingly
                    //print_r($_FILES['image']);
                    //die(); //break the code here
                    if(isset($_FILES['image']['name']))
                    {
                        //upload the image
                        //to upload the image we need image name, source path and destination path
                        $image_name = $_FILES['image']['name'];
                        if($image_name!="")
                        {
                            //auto rename image
                            //get the extensionn of our image
                            $ext = end(explode('.',$image_name));
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
                                //redirect to add category page
                                header('location'.SITEURL.'admin/add-food.php');
                                //stop the process
                                die();
                            }
                        }
                    }
                    else
                    {
                        //dont upload the image and set the image name value blank
                        $image_name="";
                    }
                    
                    //2. create sql query to insert category into database
                    //for numerical value do not need to pass value inside qoutes but  for string value it is compulsory 
                    $sql2 = "INSERT INTO tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                    ";
                    
                    //3. Exeecute the query and save in database
                    $res2 = mysqli_query($conn,$sql2);
                    
                    //4. check whther the query executed or not and data added or not
                    if($res2==true)
                    {
                        //query excuted and category addded
                        $_SESSION['add'] = "Food Added Successfully";
                        header('location:'.SITEURL.'admin/manage-food.php');
                    }
                    else
                    {
                        //failed to add food
                        $_SESSION['add'] = "Failed to add Food";
                        header('location:'.SITEURL.'admin/add-food.php');
                    }
                        
                }
            ?>
    </div>
</div>
<?php include('../partials/footer.php'); ?> 