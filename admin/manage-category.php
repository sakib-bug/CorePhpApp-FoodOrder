<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage-Category</h1>

        <br/><br/>

       <?php 

              if(isset($_SESSION['add']))
              {
              echo $_SESSION['add']; // display session message
              unset($_SESSION['add']); // remove session message
              }

              
              if(isset($_SESSION['remove']))
              {
              echo $_SESSION['remove']; // display session message
              unset($_SESSION['remove']); // remove session message
              }

              
              if(isset($_SESSION['delete']))
              {
              echo $_SESSION['delete']; // display session message
              unset($_SESSION['delete']); // remove session message
              }

              
              if(isset($_SESSION['no-founded-category']))
              {
              echo $_SESSION['no-founded-category']; // display session message
              unset($_SESSION['no-founded-category']); // remove session message
              }

              
              if(isset($_SESSION['update']))
              {
              echo $_SESSION['update']; // display session message
              unset($_SESSION['update']); // remove session message
              }

              
              if(isset($_SESSION['upload']))
              {
              echo $_SESSION['upload']; // display session message
              unset($_SESSION['upload']); // remove session message
              }

       ?>
       <br/><br/>

<!-- button to add category -->

<a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>

<br/><br/><br/><br/>


     <table class="tbl-full">
            <tr>
                   <th>S.N.</th>
                   <th>Title</th>
                   <th>Image</th>
                   <th>Featured</th>
                   <th>Active</th>
                   <th>Actions</th>
            </tr>
            <?php 

              $sql = "SELECT * FROM tbl_category";

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
                                   $image_name = $row['image_name'];
                                   $featured = $row['featured'];
                                   $active = $row['active'];

              ?>

                            <tr>
                                   <td><?php echo $sn++; ?></td>
                                   <td><?php echo $title;?></td>
                                   <td>
                                          <?php
                                                 if($image_name != "")
                                                 {
                                           ?>
                                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="" width="100px">
                                          <?php
                                                 }
                                                 else
                                                 {
                                                        echo "<div class='error'>Image not added.</div>";
                                                 }
                                          ?>
                                   </td>
                                   <td><?php echo $featured; ?></td>
                                   <td><?php echo $active; ?></td>
                                   <td>
                                          <a href="<?php echo SITEURL; ?>admin/update-category?id=<?php echo $id; ?>" class="btn-seccondary">Update Category</a>
                                          <a href="<?php echo SITEURL; ?>admin/delete-category?id=<?php echo $id; ?>&&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Category</a>
                                   </td>
                            </tr>

              <?php

                            }
                     }
                     else
                     {
              ?>
                            <tr>
                                   <td colspan='6'>
                                          <div class="error">No category addes.</div>
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