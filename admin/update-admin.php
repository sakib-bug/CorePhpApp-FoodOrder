<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
            <br/> <br/>

            <?php

            // get id of selected admin
            $id = $_GET['id'];


            // create sql query to get details
            $sql = "SELECT * FROM tbl_admin WHERE id=$id";

            //execute query
            $res = mysqli_query($conn,$sql);

            //check query

            if($res ==true)
            {
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    header('Location:'.SITEURL .'admin/manage-admin.php');
                }
            }
            else
            {

            }



            ?>

            <form action="" method="POST">

                <table class='tbl-30'>
                    <tr>
                        <td>Full name:</td>
                        <td>
                            <input type='text' name='full_name' value="<?php echo $full_name; ?>">
                        </td>
                    </tr>

                    
                    <tr>
                        <td>Username:</td>
                        <td>
                            <input type='text' name='username' value="<?php echo $username ;?>">
                        </td>
                    </tr>

                    <tr>
                        <td colspan='2'>
                            <input type="hidden" name='id' value="<?php echo $id ;?>">
                            <input type="submit" name="submit" value="Update admin" class="btn-seccondary">
                        </td>
                    </tr>


                </table>


            </form>
    </div>
</div>

<?php

// check if submit button is clicket or  not
if(isset($_POST['submit']))
{
    //get all the values from form to update
    $id=$_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    //sql query
    $sql ="UPDATE tbl_admin SET
    full_name='$full_name',
    username='$username' 
    WHERE id='$id'
     ";

     //execute query
     $res = mysqli_query($conn,$sql);

     if($res == true)
     {
         $_SESSION['update'] = "<div class='success'>Admin updated successfully</di>";
         header('location:'.SITEURL.'admin/manage-admin.php');
     }
     else
     {
        $_SESSION['update'] = "<div class='error'>Failed update admin</di>";
        header('location:'.SITEURL.'admin/manage-admin.php');
     }

}


?>


<?php include('partials/footer.php'); ?>
