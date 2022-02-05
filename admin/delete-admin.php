<?php

include('../config/constants.php');

//get id for admin who we want to delete 
 $id=$_GET['id'];

 //crete query for delete admin

 $sql = "DELETE FROM tbl_admin WHERE id='$id'";

 //execute query

 $res = mysqli_query($conn,$sql);

 // check whether the query executed succesfully or not with display message 

if($res ==true)
{
    $_SESSION['delete'] = "<div class='success'>Admin deleted successufully</div>";
    header('Location:' . SITEURL . 'admin/manage-admin.php');
}
else
{
    $_SESSION['delete'] = "<div class='error'>Failed to delete admin. Try leter adaim</div>";
    header('Location:' . SITEURL . 'admin/manage-admin.php');   
}

?>