<?php
//include constant.php file
include('../config/constants.php');
//check whether the id and image is set
if(isset($_GET['id']) AND ($_GET['image_name']!==""))
{
    //get the value and delete
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    
    //remove the physical image file if available 
    if($image_name != "")
    {
          // then only we will remove data from database
        $path = "../images/food/".$image_name;
        //remove the image
        $remove = unlink($path);
        if($remove == false)
        {
            //if failed to remove image then add an error message
            //and stop the process
            //save the session message 
            //redirect to manage-food page
            $_SESSION['remove'] = "image not removed";
            header('location:'.SITEURL.'admin/manage-food.php');
            die();
        }
    }
    else
    {
        //redirect to manage food page
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    //1. get the id of admin to be deleted
    $sql = "DELETE FROM tbl_food where id=$id";
    //execute the query
    $res = mysqli_query($conn, $sql);
    //check whether the query executed successfully or not
    if($res==true)
    {
        //echo "query executed successfully and admin deleted"; 
        //create a session variable and displa wheere ever we want 
        $_SESSION['delete'] = "<div class='success'> Food Deleted Successfully </div>";
        header('location:'.SITEURL.'admin/manage-food.php');

    }
    else
    {
        //echo "failed to delete admin";
        $_SESSION['delete'] = "<div class='error' Failed To Delete Food. Try Again Later. </div>";
         //redirect to manage-Food page with message
        header('location:'.SITEURL.'admin/manage-food.php');
    }
   
}
?>
