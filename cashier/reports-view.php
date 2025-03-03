<?php include('includes/header.php'); ?>


<style>
    .print {
        background: white;
        border: solid 1px #00BD79;
        color: #00BD79;
    }

    .print:hover {
        border-style: none;

    }

</style>
<div class="container-fluid bg-white">
    <div class="card mt-3 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Sales Report View
               <a href="reports-view-print.php?track=<?= $_GET['track'] ?>" class="btn btn-success float-end rounded-5 px-4 shadow-sm print">Print</a>
               <a href="reports.php" class="btn btn-success float-end rounded-5 px-3 mx-2">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <?php alertMessage(); ?>

            <?php
                if (isset($_GET['track'])) {

                    if($_GET['track'] == ''){
                        ?>
                        <div class="text-center py-5">
                        <h5>No Tracking Number Found</h5>
                            <div>
                                 <a href="orders.php" class="btn btn-success">Go back to orders</a>
                            </div>
                        </div>
                        <?php
                        return false;
                    }
                    $trackingNo = validate($_GET['track']);

                    $query = "SELECT o.*, c.* FROM orders o, customer c WHERE c.cid = o.customer_id 
                    AND tracking_no='$trackingNo' ORDER BY o.id DESC";

                    $orders = mysqli_query($conn, $query);
                    if ($orders && mysqli_num_rows($orders) > 0) {
                        $orderData = mysqli_fetch_assoc($orders);
                        $orderId = $orderData['id'];
                        ?>
                        <div class="row">
                            <!-- First Column -->
                            <div class="col-md-6">
                                <div class="card card-body shadow-sm border-1 mb-3 mt-0 rounded-3" style="height:17rem;">
                                    <h4 class="mb-3 mt-0">Order Details</h4>
                                    <label class="mb-1">Invoice No: 
                                        <span class="fw-semibold"><?= $orderData['invoice_no']; ?></span>
                                    </label>
                                    <br/>
                                    <label class="mb-1">Order Date: 
                                        <span class="fw-semibold"><?= $orderData['order_date']; ?></span>
                                    </label>
                                    <br/>
                                    <label class="mb-1">Order Status: 
                                        <span class="fw-semibold"><?= $orderData['order_status']; ?></span>
                                    </label>
                                    <br/>
                                    <label class="mb-1">Payment Mode: 
                                        <span class="fw-semibold"><?= $orderData['payment_mode']; ?></span>
                                    </label>
                                    <br/>
                                </div>
                            </div>
                        
                            <!-- Second Column -->
                            <div class="col-md-6">
                                <div class="card card-body shadow-sm border-1 mb-3 mt-1 rounded-3" style="height:17rem;">
                                    <h4 class="mb-3 mt-0">Customer Details</h4>
                                    <label class="mb-1">Full Name: 
                                        <span class="fw-semibold"><?= $orderData['fullname']; ?></span>
                                    </label>
                                    <br/>
                                    <label class="mb-1">Email Address: 
                                        <span class="fw-semibold"><?= $orderData['email']; ?></span>
                                    </label>
                                    <br/>
                                    <label class="mb-1">Phone Number: 
                                        <span class="fw-semibold"><?= $orderData['phone']; ?></span>
                                    </label>
                                    <br/>
                                </div>
                            </div>
                        </div>
                            <div class="col-md-12">
                                <?php
                                    $orderItemQuery = "SELECT oi.quantity as orderItemQuantity, oi.price as orderItemPrice, o.*, oi.*, p.*
                                    FROM 
                                        orders as o
                                    INNER JOIN 
                                        order_items as oi ON oi.order_id = o.id
                                    INNER JOIN 
                                        products as p ON p.id = oi.product_id
                                    WHERE 
                                        o.tracking_no='$trackingNo'";

                                    $orderItemsRes = mysqli_query($conn, $orderItemQuery);
                                    if ($orderItemsRes && mysqli_num_rows($orderItemsRes) > 0) {
                                        ?>
                                        <div class="card card-body shadow border-1 rounded-1 navbar-nav-scroll">
                                                               <h4 class="my-3 mt-0" style="margin-left:21rem;">Order Items Details</h4>
                                            <table class="table table-responsive table-borderless rounded-1 shadow-sm" style="height: 70vh; overflow-y: auto;">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Product</th>
                                                        <th class="text-center">Price</th>
                                                        <th class="text-center">Qty</th>
                                                        <th class="text-center">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($orderItemsRes as $orderItemRow): ?>
                                                        <tr>
                                                            <td>
                                                                <img src="<?= $orderItemRow['image'] != '' ? '../'.$orderItemRow['image']: '../assets/images/no-img.jpg'; ?>" 
                                                                style="width:50px; height:50px;" alt="Img" /> 
                                                                <span class="fw-semibold"><?= $orderItemRow['name']; ?></span>
                                                            </td>
                                                            <td width="15%" class="fw-semibold text-center">
                                                                <?= number_format($orderItemRow['orderItemPrice'], 0); ?>
                                                            </td>
                                                            <td width="15%" class="fw-semibold text-center">
                                                                <?= $orderItemRow['orderItemQuantity']; ?>
                                                            </td>
                                                            <td width="15%" class="fw-semibold text-center">
                                                                <?= number_format($orderItemRow['orderItemPrice'] * $orderItemRow['orderItemQuantity'], 0); ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    <tr>
                                                        <td class="text-end fw-semibold text-sm-start" style="padding-left: 15rem; padding-top: 5px;">Grand Total:</td>
                                                        <td colspan="3" class="fw-semibold text-end" style="padding-right: 56px; padding-top: 5px;"><?= number_format($orderItemRow['total_amount'], 0); ?></td>
                                                    </tr>
                                                    <tr>
                                                    <td class="text-end fw-semibold text-sm-start" style="padding-left: 15rem; padding-top: 5px;">Payment Method:</td>
                                                        <td colspan="3" class="text-end fw-semibold text-sm-start" style="padding-left: 245px; padding-top: 5px;"><?= $orderData['payment_mode']; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php
                                    } else {
                                        echo "<h5>No Order Items Found</h5>";
                                    }
                                ?>
                            </div>
                        </div>
                        <?php
                    } else {
                        echo "<h5>No Record Found</h5>";
                    }
                }else
                {
                    ?>
                    <div class="text-center py-5">
                        <h5>No Tracking Number Found</h5>
                        <div>
                            <a href="reports.php" class="btn btn-success">Go back to sales report</a>
                        </div>
                    </div>
                    
                    <?php
                }
            ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>