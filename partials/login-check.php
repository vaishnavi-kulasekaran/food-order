<?php

if(!isset($_SESSION['user']))//if user is not set
{
    //user is not logged in
    //redirect to login page
    $_SESSION['no-login-message'] = "<div class='text-center'>Please Login To Access Admin Panel</div>";
    header('location:'.SITEURL.'admin/login.php');
    
}
?>