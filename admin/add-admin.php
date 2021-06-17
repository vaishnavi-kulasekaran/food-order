<?php include("../partials/menu.php"); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br/> <br/>
        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']); //removing session
            }
        ?> 
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"></td>
                </tr>
                <tr>
                    <td>User Name</td>
                    <td><input type="text" name="user_name" placeholder="Your Username"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" placeholder="Your Password"></td>
                </tr>
                <tr colspan="2">
                    <td><input type="submit" name="submit" value="Add admin" class="btn-secondary"></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php include('../partials/footer.php'); ?>
<?php
if(isset($_POST['submit']))
{
    $full_name = $_POST['full_name'];
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    $sql = "INSERT INTO tbl_admin SET
        full_name = '$full_name',
        user_name = '$user_name',
        password = '$password'
    ";
    //executing query and saving data into database
    $res = mysqli_query($conn, $sql) or die(mysqli_error());
    
    //check whether the data is inserted or not and display appropriate message
    if($res==TRUE)
    {
        //create a session variable to display message
        $_SESSION['add'] = "Admin Added Successfully";
        //redirect page
        header("location:".SITEURL."admin/manage-admin.php");
    }
    else
    {
        echo "Data Not Inserted";
    }
    
}
?>
