<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php

        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }

    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
            
            //sql query for categories from database
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            //excute query
            $res = mysqli_query($conn,$sql);

            $count = mysqli_num_rows($res);

            if($count>0)
            {
                //Category available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the values
                    $id=$row['id'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];

            ?>

                    
            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
            <div class="box-3 float-container">

                <?php
                //chck whether image is available or not
                    if($image_name=="")
                    {
                        //display message
                        echo "<div class='error'>image not available</div>";
                    }
                    else
                    {
                        //Image available
                        ?>

                        <img src="<?php echo SITEURL ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">

                        <?php
                    }




                 ?>
                

                <h3 class="float-text text-white"><?php echo $title; ?></h3>
            </div>
            </a>


            <?php

                }
            }
            else
            {
                //Category not available
                echo "<div class='error'>Category not added.</div>";
            }
            
            ?>



            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>


             <?php

            //Dislay all food from database
            //sql query
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

            $res2 = mysqli_query($conn,$sql2);

            $count2 = mysqli_num_rows($res);

            if($count2>0)
            {
                while($row2 = mysqli_fetch_assoc($res2))
                {
                    $id2 = $row2['id'];
                    $title2 = $row2['title'];
                    $description = $row2['description'];
                    $price = $row2['price'];
                    $image_name2 = $row2['image_name'];

            ?>

                    
            <div class="food-menu-box">
                <div class="food-menu-img">

                <?php 
                
                
                //check whether image is available or not
                if($image_name2=="")
                {
                    //display message
                    echo "<div class='error'>image not available</div>";
                }
                else
                {
                    //Image available
                    ?>

                    <img src="<?php echo SITEURL ?>images/food/<?php echo $image_name2; ?>" alt="<?php echo $title2; ?>" class="img-responsive img-curve">

                    <?php
                }
                ?>
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title2; ?></h4>
                    <p class="food-price">$<?php echo $price; ?></p>
                    <p class="food-detail">
                        <?php echo $description; ?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id2; ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>


            <?php

                }
            }
            else
            {
                
                //Food not available
                echo "<div class='error'>Food not added.</div>";
            }

            




            ?>





            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>