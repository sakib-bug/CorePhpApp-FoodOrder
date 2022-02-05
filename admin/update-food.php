<?php include('partials/menu.php');  ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>

        <br/> <br/>

        <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];

                $sql = "SELECT * FROM tbl_food WHERE id='$id'";

                $res = mysqli_query($conn,$sql);

                if($res == true)
                {
                    $count = mysqli_num_rows($res);

                    if($count == 1)
                    {
                        $row = mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $current_image = $row['image_name'];
                        $category_id = $row['category_id'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                    }
                    else
                    {
                        $_SESSION['no-founded-food'] = "<div class='error'>Category not founded.</div>";
                        header('Location:'.SITEURL.'admin/manage-food.php');
                    }
                }

            }
            else
            {
                header('Location:'.SITEURL.'admin/manage-food.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title;?>">
                    </td>
                </tr>
                
                <tr>
                    <td>Desciption:</td>
                    <td>
                        <textarea type="text" name="description" cols="30" rows="5"><?php echo $description;?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price;?>">
                    </td>
                </tr>

                  
                <tr>
                    <td>Current&nbspimage:</td>
                    <td>
                        <?php
                            if($current_image != "")
                            {
                               ?>
                               <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" alt="" width='100px'>

                               <?php
                            }
                            else
                            {
                                echo "<div class='error'>Image not added</div>";
                            }
                        
                        ?>
                    </td>
                </tr>
                   
                <tr>
                    <td>New&nbspimage:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                                //sql for category
                                $sql2 = "SELECT * FROM tbl_category WHERE active='Yes'";

                                //execute query
                                $res2 = mysqli_query($conn,$sql2);

                                if($res2 == true)
                                {
                                    $count2 = mysqli_num_rows($res2);

                                    if($count2 > 0)
                                    {
                                        while($rows2 = mysqli_fetch_assoc($res2))
                                        {
                                            $id2 = $rows2['id'];
											$title2 = $rows2['title'];
                                            
                            ?>

                                        <option <?php if($id2==$category_id){echo "selected";} ?> value="<?php echo $id2; ?>"> <?php echo $title2; ?></option>

                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<option value='0'>No category founded</option>";
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured :</td>
                    <td>
                        <input <?php if($featured == "Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured == "No") {echo "checked";} ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active :</td>
                    <td>
                        <input <?php if($active == "Yes") {echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active == "No") {echo "checked";} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo "$id"; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-seccondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 

if(isset($_POST['submit']))
{

    //Get all the values from form 

    $id = $_POST['id']; 
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $current_image = $_POST['current_image'];
    $category_id = $_POST['category'];
    $featured = $_POST['featured'];
    $active= $_POST['active'];

    //Updating new image if selected
    if(isset($_FILES['image']['name']))
    {
        $image_name = $_FILES['image']['name'];
        $source_path = $_FILES['image']['tmp_name'];

        if($image_name != "")
        {
        
            $ext = explode('.',$image_name);

            $image_name = "Food-Name-".rand(000,999).'.' . end($ext);
                
            $destination_path = "../images/food/".$image_name;

            $upload = move_uploaded_file($source_path,$destination_path);

            
            if($upload==false)
            {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                header('Location:'.SITEURL."admin/manage-food.php");
                die();
            }

            //remove current image
            if($current_image !="")
            {
                $remove_path ="../images/food/". $current_image;
                $remove = unlink($remove_path);

                    
                if($remove == false)
                {
                    $_SESSION['remove'] = "<div class='error'>Failed to remove current food image.</div>";
                    header('Location'.SITEURL.'admin/manage-food.php');
                    die();
                }
            }
        }
        else
        {
            $image_name = $current_image;
        }
    }
    else
    {
        $image_name = $current_image;
    }
    //Update database
    $sql3 = "UPDATE tbl_food SET
            title ='$title',
            description='$description',
            price='$price',
            image_name='$image_name',
            category_id='$category_id',
            featured='$featured',
            active = '$active'
            WHERE id='$id'
             ";

    $res3 = mysqli_query($conn,$sql3);

    //redirect to manage category with message
?>
<?php
    if($res3 == true)
    {
        $_SESSION['update'] = "<div class='success'>Food updated successfully</div>";
        header('Location:'.SITEURL."admin/manage-food.php");
    
    }
    else
    {
       $_SESSION['update'] = "<div class='error'>Failed update food</di>";
       header('Location:'.SITEURL.'admin/manage-food.php');
    }
}
?>

<?php include('partials/footer.php'); ?>
