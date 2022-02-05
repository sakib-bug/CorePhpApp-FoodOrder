
<?php

    include('partials/menu.php');

?>

       <!-- Main Content Section Starts -->   
       <div class="main-content">

            <div class="wrapper">

                <h1>DASHBOARD</h1>
                <br/>
                <?php
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br/>

                <div class="col-4 text-center">
                    <?php 
                        //get number of categories
                        $sql = "SELECT * FROM tbl_category";
                        
                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count; ?></h1>
                    <br/>
                    Categories
                </div>

                
                <div class="col-4 text-center">
                    
                    <?php 
                        //get number of categories
                        $sql2 = "SELECT * FROM tbl_food";
                        
                        $res2 = mysqli_query($conn, $sql2);

                        $count2 = mysqli_num_rows($res2);
                    ?>
                    <h1><?php echo $count2; ?></h1>
                    <br/>
                    Foods
                </div>

                
                <div class="col-4 text-center">
                    
                     <?php 
                        //get number of categories
                        $sql3 = "SELECT * FROM tbl_order";
                        
                        $res3 = mysqli_query($conn, $sql3);

                        $count3 = mysqli_num_rows($res3);
                    ?>
                    <h1><?php echo $count3; ?></h1>
                    <br/>
                    Total Orders
                </div>

                
                <div class="col-4 text-center">
                    <?php
                        //Sql query for total revenue geerated
                        $sql4 = "SELECT SUM(total) AS total FROM tbl_order WHERE status='Delivered'";
                        $res4=mysqli_query($conn,$sql4);
                        
                        //get the value
                        $row4 = mysqli_fetch_assoc($res4);

                        $total_revenue=$row4['total'];

                        if($total_revenue==null)
                        {
                            $total_revenue="0.00";
                        }

                    ?>
                    <h1>$<?php echo " $total_revenue"; ?></h1>
                    <br/>
                    Revenue Generated
                </div>

                <div class="clearfix"></div>
             </div>  

       </div>
       <!-- Main Content Section End-->  

<?php include('partials/footer.php'); ?>