<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br/> <br/>

        <?php 

        if(isset($_SESSION['upload']))
        {
        echo $_SESSION['upload']; // display session message
        unset($_SESSION['upload']); // remove session message
        }

        ?>


        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category title">
                    </td>
                </tr>
                   
                <tr>
                    <td>Select&nbspimage:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured :</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active :</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-seccondary">

                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

<?php

if(isset($_POST['submit']))
{
    $title = $_POST['title'];

    if(isset($_POST['featured']))
    {
        $featured = $_POST['featured'];
    }
    else
    {
        $featured = "No";
    }

    if(isset($_POST['active']))
    {
        $active = $_POST['active'];
    }
    else
    {
        $active = "No";
    }
     //upload the image

    if(isset($_FILES['image']['name']))
    {
    $image_name = $_FILES['image']['name'];

    $source_path = $_FILES['image']['tmp_name'];

         if($image_name != "")
        {
                //rename

                $ext = end(explode('.',$image_name));

                $image_name = "Food_Category_".rand(000,999).'.'.$ext;
                    
                $destination_path = "../images/category/".$image_name;

                $upload = move_uploaded_file($source_path,$destination_path);


            if($upload==false)
            {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                header('Location:'.SITEURL."admin/add-category.php");
                die();
            }
        }
    }
    else
    {
        $image_name="";
    }

    //sql query for insert category to database
    $sql = "INSERT INTO tbl_category SET
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active' ";
    
    $res = mysqli_query($conn,$sql);

    if($res == true)
    {
         //data inserted
        //create a session variable to display message
        $_SESSION['add'] = "<div class='success'>Category Added Successfully</div>";
        //redirect page to manage category
        header("Location:" . SITEURL . 'admin/manage-category.php');
    }
    else
    {
        //data inserted
        //create a session variable to display message
        $_SESSION['add'] = "<div class='error'>Filed to added category</div>";
        //redirect page to manage category
        header("Location:" . SITEURL . 'admin/manage-category.php');
    }


}


?>

<?php include('partials/footer.php') ?>