<?php include('../partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <?php  
        //1. get the id of selected admin
        $id = $_GET['id'];
        //2. create sql query to get details
        $sql = "SELECT * FROM tbl_admin WHERE id=$id";
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
                $full_name = $row['full_name'];
                $user_name = $row['user_name'];
            }
            else
            {
                //redirect to manage-admin
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="user_name" value="<?php echo $user_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin " class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
//check whether the admin button is clicked or not
if(isset($_POST['submit']))
{
    //echo "Button Clicked";
    //get all values from form to update
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $user_name = $_POST['user_name'];
    
    $sql1 = "UPDATE tbl_admin SET
    full_name = '$full_name',
    user_name = '$user_name'
    WHERE id = '$id'
    ";
    
    //Execute the query 
    $res1 = mysqli_query($conn, $sql1) or die(mysqli_error());
    
    //check whether the query is excuted
    if($res1==true)
    {
        //Query excuted 
        $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //failed to update
        $_SESSION['update'] = "<div class='error'>Failed to update admin</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
      
}

?>

<?php include('../partials/footer.php'); ?>
