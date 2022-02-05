<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br/> <br/>

        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Enter title">
                    </td>
                </tr>

                <tr>
                    <td>Desciption:</td>
                    <td>
                        <textarea type="text" name="description" placeholder="Description of the food" cols="30" rows="5"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" placeholder="Enter price of food">
                    </td>
                </tr>

                <tr>
                    <td>Select&nbspimage:</td>
                    <td>
                        <input type="file" name="image">
                    </td> 
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <option value="-1">-select category-</option>
                            <?php
                                //sql for category
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes';";

                                //execute query
                                $res = mysqli_query($conn,$sql);

                                if($res == true)
                                {
                                    $count = mysqli_num_rows($res);

                                    if($count > 0)
                                    {
                                        while($rows = mysqli_fetch_assoc($res))
                                        {
                                            $id = $rows['id'];
											$title = $rows['title'];
                                            
                            ?>

                                            <option value="<?php echo $id; ?>"> <?php echo $title; ?></option>

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
                        <input type="submit" name="submit" value="Add Food" class="btn-seccondary">

                    </td>
                </tr>
            </table>
        </form>

        <?php

        if(isset($_POST['submit']))
        {
            //add food in database
            //get data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            //featured and active
            if(isset($_POST['featured']))
            {
                $featured = $_POST['featured'];
            }
            else
            {
                $featured ="No";
            }

            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else
            {
                $active ="No";
            }
            //upload image if selected
            if(isset($_FILES['image']['name']))
            {
                $image_name = $_FILES['image']['name'];

                if($image_name != "")
                {
                    $array = explode('.', $image_name);
                    $ext = end($array);

                    //create new name for image
                    $image_name = "Food-Name-".rand(0000,9999).".".$ext;

                    $src = $_FILES['image']['tmp_name'];

                    $dst ="../images/food/".$image_name;

                    $upload = move_uploaded_file($src,$dst);

                    if($upload == false)
                    {
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                        header('Loacation:'.SITEURL.'admin/add-food.php');
                        die();
                    }
                }
            }
            else
            {
                $image_name ="";
            }

            //insert into database
            $sql2 = "INSERT INTO tbl_food SET
                    title='$title',
                    description='$description',
                    price='$price',
                    image_name='$image_name',
                    category_id='$category',
                    featured='$featured',
                    active='$active'";

            $res2 = mysqli_query($conn,$sql2);

            //redirect t manage food with message

            if($res2 == true)
            {
                //data inserted
                //create a session variable to display message
                $_SESSION['add'] = "<div class='success'>Food Added Successfully</div>";
                //redirect page to manage category
                header("Location:" . SITEURL . 'admin/manage-food.php');
            }
            else
            {
                //data inserted
                //create a session variable to display message
                $_SESSION['add'] = "<div class='error'>Filed to added food</div>";
                //redirect page to manage category
                header("Location:" . SITEURL . 'admin/manage-food.php');
            }

        }



         ?>
    </div>
</div>







<?php include('partials/footer.php'); ?>