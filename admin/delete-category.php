<?php 

include('../config/constants.php');


//check is set id and image name

if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    //get the value and delete 
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if($image_name != "")
    {
        $path ="../images/category/".$image_name;

        $remove_image = unlink($path);

        if($remove_image == false)
        {
            $_SESSION['remove'] = "<div class='error'>Failed toremove category image.</div>";
            header('Location'.SITEURL.'admin/manage-category.php');
            die();
        }
    }

    $sql = "DELETE FROM tbl_category WHERE id='$id'";

    $res = mysqli_query($conn,$sql);

    if($res == true)
    {
        $_SESSION['delete']= "<div class='success'>Category delete successfully</div>";
        header('Location:'.SITEURL.'admin/manage-category.php');
    }
    else
    {
        $_SESSION['delete']= "<div class='error'>Failed to delete category</div>";
        header('Location:'.SITEURL.'admin/manage-category.php');
    }
}
else
{
    //redirect to manage category
    header('Location'.SITEURL.'admin/manage-category.php');
}

?>