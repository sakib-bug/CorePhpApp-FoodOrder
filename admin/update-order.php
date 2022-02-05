<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br/> <br/>

        <?php

        if(isset($_GET['id']))
        {
            $id=$_GET['id'];

            $sql = "SELECT * FROM tbl_order WHERE id=$id";

            $res = mysqli_query($conn,$sql);

            $count = mysqli_num_rows($res);

            if($count == 1)
            {
                //we have data
                $row = mysqli_fetch_assoc($res);
                //all data from database
                $food =$row['food'];
                $price=$row['price'];
                $qty = $row['qty'];
                $total = $row['total'];
                $order_date =$row['order_date'];//order date
                $status = $row['status']; //Ordered , On delivered , Delivered, Cancelled
                $customer_name =$row['customer_name'];
                $customer_contact =$row['customer_contact'];
                $customer_email =$row['customer_email'];
                $customer_address =$row['customer_address'];
            }
            else
            {
                //dont have data
                header('Location:'.SITEURL.'admin/manage-order.php');
            }

        }
        else
        {
            header('Location:'.SITEURL.'admin/manage-order.php');
        }


        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food name:</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td><b>$<?php echo $price; ?></b></td>
                </tr>

                <tr>
                    <td>Qty:</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On delivery"){echo "selected";} ?> value="On delivery">On delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Canceled</option>
                    </td>
                </tr>

                <tr>
                    <td>Customer name:</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>Customer contact:</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>Customer email:</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>Customer address:</td>
                    <td>
                        <textarea type="text" name="customer_address" cols="22" rows="5" ><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update order" class="btn-seccondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php

            if(isset($_POST['submit']))
            {
                $id=$_POST['id'];
                $price=$_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;

                $status=$_POST['status'];

                $customer_name =$_POST['customer_name'];
                $customer_contact =$_POST['customer_contact'];
                $customer_email =$_POST['customer_email'];
                $customer_address =$_POST['customer_address'];

                //update values

                $sql2="UPDATE tbl_order SET
                        qty=$qty,
                        total=$total,
                        status='$status',
                        customer_name='$customer_name',
                        customer_contact='$customer_contact',
                        customer_email='$customer_email',
                        customer_address='$customer_address'
                        WHERE id=$id
                    ";

                $res2 = mysqli_query($conn,$sql2);

                if($res2==true)
                {
                    $_SESSION['update']="<div class='success'>Order update successfully.</div>";
                    header('Location:'.SITEURL.'admin/manage-order.php');
                }
                else
                {
                    
                    $_SESSION['update']="<div class='error'>Failed update order.</div>";
                    header('Location:'.SITEURL.'admin/manage-order.php');
                }
            }


        ?>
    </div>
</div>



<?php include('partials/footer.php') ?>