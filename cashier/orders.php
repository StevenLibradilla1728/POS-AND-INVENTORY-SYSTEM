<?php include('includes/header.php'); ?>

<div class="container-fluid bg-white">
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-white">
            <div class="row">
                <div class="col-md-3">
                <h4>Orders</h4>
                    
                </div>
                <div class="col-md-7">
                    <form action="" method="GET">
                        <div class="row g-1">
                            <div class="col-md-3">
                                <input type="date" name="date"
                                class="form-control"
                                 value="<?= isset($_GET['date']) == true ? $_GET['date']: ''  ?>">
                            </div>
                            <!--<div class="col-md-3 mx-2">
                                <select name="payment_status" class="form-select" id="">
                                    <option value="">Select Payment Status</option>
                                    
                                    <option value="Cash Payment"
                                    <?= isset($_GET['payment_status']) == true ? 
                                    ($_GET['payment_status'] == 'Cash Payment' ? 'selected': ''): ''; ?>
                                    >Cash Payment</option>
                                    
                                    <option value="Online Payment"
                                    <?= isset($_GET['payment_status']) == true ? 
                                    ($_GET['payment_status'] == 'Online Payment' ? 'selected': ''): ''; ?>
                                    >Online Payment</option>
                                </select>
                            </div>-->
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="orders.php" class="btn btn-danger">Reset</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            <?php

              if(isset($_GET['date']) || isset($_GET['payment_status'])){
                   $orderDate = validate($_GET['date']);
                   /*$paymentStatus = validate($_GET['payment_status']);*/

                   if($orderDate != ''){
                       $query = "SELECT o.*, c.* FROM orders o, customer c 
                       WHERE c.cid = o.customer_id AND o.order_date='$orderDate' ORDER BY o.id DESC";

                   }elseif($orderDate == ''){
                       $query = "SELECT o.*, c.* FROM orders o, customer c 
                       WHERE c.cid = o.customer_id ORDER BY o.id DESC";
                   }elseif($orderDate != ''){
                       $query = "SELECT o.*, c.* FROM orders o, customer c WHERE c.cid = o.customer_id 
                       AND o.order_date='$orderDate'
                       ORDER BY o.id DESC";
                   }else{
                    $query = "SELECT o.*, c.* FROM orders o, customer c 
                    WHERE c.cid = o.customer_id ORDER BY o.id DESC";
                   }  
              }else{
                $query = "SELECT o.*, c.* FROM orders o, customer c 
                WHERE c.cid = o.customer_id ORDER BY o.id DESC";
              }
             
              $orders = mysqli_query($conn, $query);
              if($orders){

                if(mysqli_num_rows($orders) > 0)
                {
                    ?>
                    <table class="table table-bordered align-items-center justify-content-center" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Invoice No.</th>
                                <th>Customer Full Name</th>
                                <th>Customer Phone</th>
                                <th>Order Date</th>
                                <th>Order Status</th>
                                <th>Payment Mode</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($orders as $orderItem) : ?>
                                <tr>
                                    <td class="fw-bold"><?= $orderItem['invoice_no']; ?></td>
                                    <td><?= $orderItem['fullname']; ?></td>
                                    <td><?= $orderItem['phone']; ?></td>
                                    <td><?= date('d M, Y', strtotime($orderItem['order_date'])); ?></td>
                                    <td><?= $orderItem['order_status']; ?></td>
                                    <td><?= $orderItem['payment_mode']; ?></td>
                                    <td>
                                    <a href="orders-view.php?track=<?= $orderItem['tracking_no']; ?>" class="btn btn-primary mb-0 px-2 btn-sm">View</a>
                                    <a href="orders-view-print.php?track=<?= $orderItem['tracking_no']; ?>" class="btn btn-success mb-0 px-2 btn-sm">Print</a></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <?php

                }
                else
                {
                    echo "<h5>No Record Available</h5>";
                }
              }
              else
              {
                echo "<h5>Something Went Wrong</h5>";
              }
            ?>

        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>