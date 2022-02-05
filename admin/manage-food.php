<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage-Food</h1>

        <br/><br/>

        
        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        
       <?php
            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
        ?>

        
       <?php
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
        ?>

        <?php
              if(isset($_SESSION['no-founded-food']))
              {
                     echo $_SESSION['no-founded-food'];
                     unset($_SESSION['no-founded-food']);
              }
        ?>
        
        
        <?php
              if(isset($_SESSION['upload']))
              {
                     echo $_SESSION['upload'];
                     unset($_SESSION['upload']);
              }
        ?>

        
       <?php
              if(isset($_SESSION['update']))
              {
                     echo $_SESSION['update'];
                     unset($_SESSION['update']);
              }
        ?>

        <br/><br/>

<!-- button to add admin -->

<a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>

<br/><br/><br/><br/>


     <table class="tbl-full">
            <tr>
                   <th>S.N.</th>
                   <th>Title</th>
                   <th>Description</th>
                   <th>Price</th>
                   <th>Image</th>
                   <th>Category</th>
                   <th>Featured</th>
                   <th>Active</th>
                   <th>Actions</th>
            </tr>

            
            <?php 

              $sql = "SELECT * FROM tbl_food";

              $res = mysqli_query($conn,$sql);

              if($res == true)
              {
                     $count = mysqli_num_rows($res);

                     if($count>0)
                     {
                            $sn = 1;

                            while($row = mysqli_fetch_assoc($res))
                            {
                                   $id = $row['id'];
                                   $title = $row['title'];
                                   $description = $row['description'];
                                   $price = $row['price'];
                                   $image_name = $row['image_name'];
                                   $category_id = $row['category_id'];
                                   $featured = $row['featured'];
                                   $active = $row['active'];

              ?>

                            <tr>
                                   <td><?php echo $sn++; ?></td>
                                   <td><?php echo $title;?></td>
                                   <td><div style="max-width:120px;"><?php echo $description; ?></div></td>
                                   <td><?php echo $price . " $"; ?></td>
                                   <td>
                                          <?php
                                                 if($image_name != "")
                                                 {
                                           ?>
                                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="" width="100px">
                                          <?php
                                                 }
                                                 else
                                                 {
                                                        echo "<div class='error'>Image not added.</div>";
                                                 }
                                          ?>
                                   </td>
                                   <td>
                                          <?php 
                                                 //sql for category with category id
                                                 $sql2 = "SELECT * FROM tbl_category WHERE id='$category_id' ";
                                                 $res2 = mysqli_query($conn,$sql2);
                                                 $count = mysqli_num_rows($res2);
                                                 if($count==1)
                                                 {
                                                        $row = mysqli_fetch_assoc($res2);
                                                        $category = $row['title'];
                                                 }
                                                 else
                                                 {
                                                        $category = "Category not founded";
                                                 }

                                                 echo $category;
                                          ?>
                                   </td>
                                   <td><?php echo $featured; ?></td>
                                   <td><?php echo $active; ?></td>
                                   <td>
                                          <a href="<?php echo SITEURL; ?>admin/update-food?id=<?php echo $id; ?>" class="btn-seccondary">Update Food</a>
                                          <a href="<?php echo SITEURL; ?>admin/delete-food?id=<?php echo $id; ?>&&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a>
                                   </td>
                            </tr>

              <?php

                            }
                     }
                     else
                     {
              ?>
                            <tr>
                                   <td colspan='9'>
                                          <div class="error">No food addes.</div>
                                   </td>
                            </tr>
               <?php
                     }
              }
            ?>



     </table>


    </div>
</div>


<?php include('partials/footer.php'); ?>