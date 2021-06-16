<?php
//include constant.php file
include('../config/constants.php');
//1. get the id of admin to be deleted
echo $id = $_GET['id'];
//2. create sql query to delete admin
$sql = "DELETE FROM tbl_admin where id=$id";
//execute the query
$res = mysqli_query($conn, $sql);
//check whether the query executed successfully or not
if($res==true)
{
    //echo "query executed successfully and admin deleted"; 
    //create a session variable and displa wheere ever we want 
    $_SESSION['delete'] = "<div class='success'> admin deleted successfully </div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
        
}
else
{
    //echo "failed to delete admin";
    $_SESSION['delete'] = "<div class='error' Failed To Delete Admin. Try Again Later. </div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}
//3. redirect to manage admin page with message success or error
