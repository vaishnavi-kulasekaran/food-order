<?php include("../partials/menu.php"); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
        
        
        <?php
        //get id
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
        }
        ?>
        
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="current password">
                    </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="new password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="confirm password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input class="btn-secondary"type="submit" name="submit" value="change_password">
                    </td>
                </tr>
                
            </table>
        </form>
    </div>
</div>
<?php 
//check whether the submit buttom clicked or not 
if(isset($_POST['submit']))
{
    //1. get the data from form 
    $id = $_POST['id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    //2.check whether the current id and current password exist
    $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password = '$current_password'";
    //execut query
    $res = mysqli_query($conn, $sql);  

    if($res==true)
    {
        //check whether data is available or not
        $count = mysqli_num_rows($res);
        if($count==1)
        {
            //user exist and password can be changed
            //echo "USER FOUND";
            //check whether new password and confirm password match or not
            if($new_password==$confirm_password)
            {
                //update the password
                $sql1 = "UPDATE tbl_admin SET
                password = '$new_password'
                where id  = $id"
                ;
                
                //execute query
                $res2 = mysqli_query($conn, $sql1);
                
                //check whether queery is execued or not
                if($res==true)
                {
                    $_SESSION['password_updated'] = "<div  class='success'>password updated </div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
                else
                {
                    $_SESSION['password_updated'] = "<div  class='error'>password is not changed</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {
                //user does not exist set message and redirect
                $_SESSION['password_did_not_match'] = "<div  class='error'>password did not match </div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        else
        {
            //user does not exist set message and direct
            $_SESSION['user_not_found'] = "<div  class='error'> User Not Found </div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
}

//3. check whether new password and confirm password match or not

//4. update password if all above is correct 
?>
<?php include('../partials/footer.php'); ?>