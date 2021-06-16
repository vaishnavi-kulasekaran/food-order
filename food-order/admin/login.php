<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title> Login-Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br>
            <?php
            if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']); //removing session
                }
            if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']); //removing session
                }
            echo nl2br("\n");
            ?>
            <br>
            <!-- login form starts here -->
            <form action="" method="POST" class="text-center">
            Username: <input type="text" name="user_name" placeholder="Enter Username"><br><br>
            Password: <input type="password" name="password" placeholder="enter password"><br><br><br>
            <input type="submit" name="submit" value="login" class="btn-primary"><br><br>
             </form>
            <!-- login form ends here -->
        </div>
    </body>
</html>
<?php 
//check whether thhe submit button is clicked or not 
if(isset($_POST['submit']))
{
    //process for login
    //1. get the data from form
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    
    //2. sql to check whether the user with username and password exist or not
    $sql = "SELECT * FROM tbl_admin WHERE
    user_name = '$user_name'AND password = '$password'";
    
    //3. execute query
    $res = mysqli_query($conn, $sql);
    
    //4. count rows to check whether the user exist or not 
    $count = mysqli_num_rows($res);
    
    if($count==1)
    {
        //there is atleast one user and login success
        //to check whether the user is logged in or not and logout will unset it
        $_SESSION['user'] = $user_name;
        header('location:'.SITEURL.'admin/');
        
    }
    else
    {
        //user not available
        $_SESSION['login'] = "<div class='text-center'>Login Failed</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
}
?>