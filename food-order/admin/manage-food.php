<?php include('../partials/menu.php'); ?>
<div class="main-content">
   <div class="wrapper">
       <h1>Manage Food</h1>
    </div>
</div>
<br/> <br/> <br/>          
             <!-- Button To Add Admin -->
             <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>  
             <br/> <br/> <br/>  
             <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']); //removing session
                    }
                    if(isset($_SESSION['remove']))
                    {
                        echo $_SESSION['remove'];
                        unset($_SESSION['remove']); //removing session
                    }
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']); //removing session
                    }
                    if(isset($_SESSION['category-not-found']))
                    {
                        echo $_SESSION['category-not-found'];
                        unset($_SESSION['category-not-found']);//removing session
                    }
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']); //removing session
                    }
                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']); //removing session
                    }
                    if(isset($_SESSION['remove_failed']))
                    {
                        echo $_SESSION['remove_failed'];
                        unset($_SESSION['remove_failed']);
                    }
             ?>                  
             <table class="tbl-full">
                 <tr>
                     <th>S.No</th>
                     <th>Title</th>
                     <th>Description</th>
                     <th>Price</th>  
                     <th>Image</th>
                     <th>Category Id</th>
                     <th>Featured</th> 
                     <th>Active</th>
                     <th>Actions</th>
                 </tr>
                 <?php
                     $sql = "SELECT * FROM tbl_food";
                     $res = mysqli_query($conn,$sql);
                     if($res==TRUE)
                     {
                         //count rows to check data in database
                         $count = mysqli_num_rows($res); //function to get all rows in database
                         $sno = 1; //create a variable and assign a value
                         //check the num of rows
                         if($count > 0)
                         {
                             //we have data in database
                             while($rows=mysqli_fetch_assoc($res))
                             {
                                 //using while loop to get all data from database
                                 //and while loop will run as long as the database has data

                                 //get individual data
                                 $id = $rows['id'];
                                 $title = $rows['title'];
                                 $description = $rows['description'];
                                 $price = $rows['price'];
                                 $image_name = $rows['image_name'];
                                 $category_id = $rows['category_id'];
                                 $featured = $rows['featured'];
                                 $active = $rows['active'];
                                 //display the values in our table
                                 ?>
                                 <tr>
                                     <td><?php echo $sno ++ ; ?></td>
                                     <td><?php echo $title; ?></td>
                                     <td><?php echo $description; ?></td>
                                     <td><?php echo "Rs.".$price; ?></td>
                                     <td><?php 
                                         if($image_name!="")
                                         {
                                            //display the image
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px" height="100px" >
                                            <?php
                                         }
                                        else
                                        {
                                            //diplay the image
                                            echo "Image not added";
                                        }
                                         ?>
                                     </td>
                                     <td><?php echo $category_id; ?></td>
                                     <td><?php echo $featured; ?></td>
                                     <td><?php echo $active; ?></td>
                                     <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Update Food</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                                     </td> 
                                 </tr>
                                 <?php
                             }
                         }
                         else
                         {
                             echo "do not have any value in the table"; 
                         }
                     }
                 ?>
                 
                
             </table>
 
<?php include('../partials/footer.php'); ?>