<?php include('../partials/menu.php'); ?>
<div class="main-content">
   <div class="wrapper">
       <h1>Manage Order</h1>
        </div>
</div>
             <br/> <br/> <br/>          
             <!-- Button To Add Admin -->
                               
             <table class="tbl-full">
                 <tr>
                     <th>S.No</th>
                     <th>Food</th>
                     <th>price</th>
                     <th>quantity</th>  
                     <th>total</th>
                     <th>order_date</th>
                     <th>status</th>
                     <th>customer_name</th>
                     <th>customer_contact</th>
                     <th>customer_email</th>
                     <th>customer_address</th>
                 </tr>
                 
                <?php
                     $sql = "SELECT * FROM tbl_order";
                     $res = mysqli_query($conn, $sql);
                     $count = mysqli_num_rows($res);
                     $sno = 1;
                     if($count>0)
                     {
                         while($row=mysqli_fetch_assoc($res))
                         {
                             $food = $row['food'];
                             $price = $row['price'];
                             $quantity = $row['quantity'];
                             $total = $row['total'];
                             $order_date = $row['order_date'];
                             $status = $row['status']; //ordered, on-delivery, delivered, cancelled
                             $customer_name = $row['customer_name'];
                             $customer_contact =$row['customer_contact'];
                             $customer_email = $row['customer_email'];
                             $customer_address = $row['customer_address'];
                ?>
                <tr>
                     <td><?php echo $sno++; ?></td>
                     <td><?php echo $food; ?></td>
                     <td><?php echo $price; ?></td>
                     <td><?php echo $quantity; ?></td>
                     <td><?php echo $total; ?></td>
                     <td><?php echo $order_date; ?></td>
                     <td><?php echo $status; ?></td>
                     <td><?php echo $customer_name; ?></td>
                     <td><?php echo $customer_contact; ?></td>
                    <td><?php echo $customer_email; ?></td>
                    <td><?php echo $customer_address;  ?></td>
                    <td>
                         <a href="#" class="btn-secondary">Update Admin</a>
                     </td>
                 </tr>
                 <?php
                 }
            }
            else
            {
                echo "do not have any value";
            }
            ?>
            </table>
    
<?php include('../partials/footer.php'); ?>