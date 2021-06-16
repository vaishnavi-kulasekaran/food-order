<?php include('../partials/menu.php'); ?>
<div class="main-content">
   <div class="wrapper">
       <h1>Manage Category</h1>
    </div>
</div>
             <br/> <br/> <br/>          
             <!-- Button To Add Admin -->
             <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>  
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
                    if(isset($_SESSION['failed-remove']))
                    {
                        echo $_SESSION['failed-remove'];
                        unset($_SESSION['failed-remove']);
                    }
             ?>
             <table class="tbl-full">
                 <tr>
                     <th>S.No</th>
                     <th>Title</th>
                     <th>Image</th> 
                     <th>Featured</th> 
                     <th>active</th> 
                     <th>Actions</th> 
                 </tr>
                 <?php
                 $sql = "SELECT * FROM tbl_category";
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
                             $image_name = $rows['image_name'];
                             $featured = $rows['featured'];
                             $active = $rows['active'];
                             //display the values in our table
                 ?>
                             <tr>
                                 <td><?php echo $sno ++ ; ?></td>
                                 <td><?php echo $title; ?></td>
                                 
                                 <td><?php 
                                     if($image_name!="")
                                     {
                                        //display the image
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px" height="100px" >
                                        <?php
                                     }
                                    else
                                    {
                                        //diplay the image
                                        echo "Image not added";
                                    }
                                     ?>
                                 </td>
                                 
                                 <td><?php echo $featured; ?></td>
                                 <td><?php echo $active; ?></td>
                                 <td>
                                    <a href="http://localhost/php/food-order/admin/update_category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Update Category</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
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
<br><br>
<?php include('../partials/footer.php'); ?>