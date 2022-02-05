
<?php 
    include('../config/constants.php');
?>
<html>
    <head>
        <title>Login - Food order system</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br/><br/>
            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br/>

            <form action="" method="POST" class="text-center">
                Username : <br/>
                <input type="text" name="username" placeholder="Enter your username"> <br/><br/>
                Password: <br/>
                <input type="password" name="password" placeholder="Enter your password"><br/><br/>
                <input type="submit" name="submit" value="Login" class="btn-primary">
            </form>

            <p class="text-center">Created by Sakib Korenic</p>
        </div>
    </body>
</html>


<?php

if(isset($_POST['submit']))
{
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    $res = mysqli_query($conn,$sql);

    $count = mysqli_num_rows($res);

    if($count == 1)
    {
        $_SESSION['login'] = "<div class='success'>Login successfull</div>";
        $_SESSION['user'] = $username;
        header('Location:'.SITEURL.'admin/');
    }
    else
    {
        $_SESSION['login'] = "<div class='error text-center'>Login failed: username or password is wrong !!</div>";
        header('Location:'.SITEURL.'admin/login.php');
    }
}


?>