<?php include("../partials/menu.php"); ?>
       <!--Main Content Section Starts-->
       <div class="main-content">
           <div class="wrapper">
             <h1>Manage Admin</h1>
             <div class="clearfix"></div>    
           </div>
       </div>
             <br/> <br/> <br/>          
             <!-- Button To Add Admin -->
             <a href="add-admin.php" class="btn-primary">Add Admin</a>  
             <br> <br> <br>  
             <?php 
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']); //removing session
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']); //removing session
                }
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']); //removing session
                }
                if(isset($_SESSION['user_not_found']))
                {
                    echo $_SESSION['user_not_found'];
                    unset($_SESSION['user_not_found']); //removing session
                }
                if(isset($_SESSION['password_did_not_match']))
                {
                    echo $_SESSION['password_did_not_match'];
                    unset($_SESSION['password_did_not_match']); //removing session
                }
                if(isset($_SESSION['password_updated']))
                {
                    echo $_SESSION['password_updated'];
                    unset($_SESSION['password_updated']); //removing session
                }
               ?> 
               <br>  
                            
             <table class="tbl-full">
                 <tr>
                     <th>S.No</th>
                     <th>Full Name</th>
                     <th>Username</th>
                     <th>Actions</th>  
                 </tr>
                 <?php
                 $sql = "SELECT * FROM tbl_admin";
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
                             $full_name = $rows['full_name'];
                             $user_name = $rows['user_name'];
                             
                             //display the values in our table
                             ?>
                             <tr>
                                 <td><?php echo $sno ++ ; ?></td>
                                 <td><?php echo $full_name; ?></td>
                                 <td><?php echo $user_name; ?></td>
                                 <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
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
       <!--Main Content Section Ends-->

       <!--Footer Section Starts-->
       <br /> <br />
<?php include("../partials/footer.php"); ?>