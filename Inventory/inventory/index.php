<?php include('includes/header.php'); ?>

<style>
    

    .title {
        font-size: 16px;
        margin: 0 1rem 0 4.7rem;
        text-transform: uppercase;
        font-weight: bold;
    }
    .total {
        font-size: 28px;
        margin: 0 1rem 0 7.2rem;
        text-transform: uppercase;
        font-weight: bold;
    }

    .analytics1 {
        color: white;
        height: 6.3rem;
        background-color: #00DBDE;
        background-image: linear-gradient(90deg, #00DBDE 0%, #6284ff 100%);
  
    }

    .analytics2 {
        color: white;
        height: 6.3rem;
        background-color: #ffffff;
        background-image: linear-gradient(43deg, #ffffff 0%, #0cd18a 1%, #0bcbb3 85%);

    }
    .analytics3 {
        color: white;
        height: 6.3rem;
        background-color: #FAD961;
        background-image: linear-gradient(90deg, #FAD961 0%, #F76B1C 100%);

    }
</style>
<div class="container-fluid px-4">
                       
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="mt-0 pt-0 py-2">Dashboard</h4>
                                <?php alertMessage(); ?>
                            </div>

                            <div class="col-md-4 mb-3">
                            <div class="card border-left-primary shadow h-100">
                                <div class="card card-body p-3 analytics1" style="margin-bottom: 2px">
                                    <p class="title">Total Category</p>
                                    <h5 class="fw-bold mb-0 total">
                                        <?= getCount('categories') ?>
                                    </h5>
                                </div>
                            </div>
                            </div>

                            <div class="col-md-4 mb-3">
                            <div class="card border-left-primary shadow h-100">
                                <div class="card card-body p-3 analytics2" style="margin-bottom: 2px">
                                    <p class="title">Total Products</p>
                                    <h5 class="fw-bold mb-0 total">
                                        <?= getCount('products') ?>
                                    </h5>
                                </div>
                            </div>
                            </div>

                            <div class="col-md-4 mb-3">
                            <div class="card border-left-primary shadow h-100">
                                <div class="card card-body p-3 analytics3" style="margin-bottom: 2px">
                                    <p class="title">Total Cashier</p>
                                    <h5 class="fw-bold mb-0 total">
                                        <?= getCount('cashiers') ?>
                                    </h5>
                                </div>
                            </div>
                            </div>

                            <div class="col-md-4 mb-3">
                            <div class="card border-left-primary shadow h-100">
                                <div class="card card-body p-3 analytics2" style="margin-bottom: 2px">
                                    <p class="title">Total Customers</p>
                                    <h5 class="fw-bold mb-0 total">
                                        <?= getUniqueCustomerCount('orders', 'customer_id') ?>
                                    </h5>
                                </div>
                            </div>
                            </div>

                            <div class="col-md-4 mb-3">
                            <div class="card border-left-primary shadow h-100">
                                <div class="card card-body p-3 analytics3" style="margin-bottom: 2px">
                                    <p class="title">Total Orders</p>
                                    <h5 class="fw-bold mb-0 total">
                                        <?= getCount('orders') ?>
                                    </h5>
                                </div>
                            </div>
                            </div>

                            <div class="col-md-4 mb-3">
                            <div class="card border-left-primary shadow h-100">
                                <div class="card card-body p-3 analytics1" style="margin-bottom: 2px">
                                    <p class="title">Today Orders</p>
                                    <h5 class="fw-bold mb-0 total">
                                        <?php 
                                            $todayDate = date('Y-m-d');
                                            $todayOrders = mysqli_query($conn, "SELECT * FROM orders WHERE order_date='$todayDate' ");
                                            if($todayOrders) {
                                                if(mysqli_num_rows($todayOrders) > 0) {
                                                    $totalCountOrders = mysqli_num_rows($todayOrders);
                                                    echo $totalCountOrders;
                                                }else{
                                                    echo 0;
                                                }
                                            }else{
                                                echo 'Something Went Wrong!';
                                            }

                                        ?>
                                    </h5>
                                </div>
                            </div>
                        </div>


                        
                        </div>
                        
                        <div class="card mt-2 shadow-sm">
        <div class="card-header bg-white">
            <div class="row">
                <div class="col-md-3">
                    <h4 class="mb-0">Recent Orders
                        <!--<a href="order-create.php" class="btn btn-success float-end rounded-5 px-4">Back</a>-->
                    </h4>
                </div>
                
            </div>
        </div>

        <div class="card-body">
            <?php

              if(isset($_GET['date']) || isset($_GET['payment_status'])){
                   $orderDate = validate($_GET['date']);
                   $paymentStatus = validate($_GET['payment_status']);

                   if($orderDate != '' && $paymentStatus == ''){
                       $query = "SELECT o.*, c.* FROM orders o, customer c 
                       WHERE c.cid = o.customer_id AND o.order_date='$orderDate' ORDER BY o.id DESC";

                   }elseif($orderDate == '' && $paymentStatus != ''){
                       $query = "SELECT o.*, c.* FROM orders o, customer c 
                       WHERE c.cid = o.customer_id AND o.payment_mode='$paymentStatus' ORDER BY o.id DESC";
                   }elseif($orderDate != '' && $paymentStatus != ''){
                       $query = "SELECT o.*, c.* FROM orders o, customer c WHERE c.cid = o.customer_id 
                       AND o.order_date='$orderDate'
                       AND o.payment_mode='$paymentStatus' 
                       ORDER BY o.cid DESC";
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
                                    <a href="dash-orders-view.php?track=<?= $orderItem['tracking_no']; ?>" class="btn btn-primary mb-0 px-2 btn-sm">View</a>
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

<?php include('includes/footer.php'); ?>