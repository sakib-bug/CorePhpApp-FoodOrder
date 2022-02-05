<?php
//Authorization - Access control
//Check user login or not 
if(!isset($_SESSION['user']))
{
//redirect to login page with message
$_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin panel.</div>";

header('Location:'.SITEURL.'admin/login.php');

}

?>