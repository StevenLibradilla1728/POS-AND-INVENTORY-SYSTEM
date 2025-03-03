<?php include('includes/header.php'); ?>

<style>
    

    .title {
        font-size: 16px;
        margin: 0 1rem 0 4.9rem;
        text-transform: uppercase;
        font-weight: bold;
    }
    .total {
        font-size: 28px;
        margin: 0 1rem 0 5.2rem;
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
<div class="container-fluid bg-white">
                       
                        <div class="row">
                            <div class="col-md-11 mb-2">
                                <?php alertMessage(); ?>
                            </div>

                            
                            <div class="col-md-4 mb-2">
                            <div class="card border-left-primary shadow h-100">
                                <div class="card card-body p-3 analytics2" style="margin-bottom: 2px">
                                    <p class="title">Total Sales</p>
                                    <h5 class="fw-bold mb-0 total">
                                    ₱<?= number_format(getTableColumnSum('orders', 'total_amount')) ?>
                                    </h5>
                                </div>
                            </div>
                            </div>

                            <div class="col-md-4 mb-2">
                            <div class="card border-left-primary shadow h-100">
                                <div class="card card-body p-3 analytics3" style="margin-bottom: 2px">
                                    <p class="title">Inventory Cost</p>
                                    <h5 class="fw-bold mb-0 total">
                                    ₱<?= number_format(getTotalValueByStock('products', 'price', 'stock_level')) ?>
                                    </h5>
                                </div>
                            </div>
                            </div>

                            <div class="col-md-4 mb-2">
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
                                <h4>Sales Report</h4>
                                <form method="GET" class="d-flex justify-content-end">
                                    <select name="timeframe" class="form-select" style="width: 10rem; margin-right: 0.2rem;">
                                        <option value="all" <?= isset($_GET['timeframe']) && $_GET['timeframe'] == 'all' ? 'selected' : '' ?>>All</option>
                                        <option value="daily" <?= isset($_GET['timeframe']) && $_GET['timeframe'] == 'daily' ? 'selected' : '' ?>>Daily</option>
                                        <option value="weekly" <?= isset($_GET['timeframe']) && $_GET['timeframe'] == 'weekly' ? 'selected' : '' ?>>Weekly</option>
                                        <option value="monthly" <?= isset($_GET['timeframe']) && $_GET['timeframe'] == 'monthly' ? 'selected' : '' ?>>Monthly</option>
                                        <option value="quarterly" <?= isset($_GET['timeframe']) && $_GET['timeframe'] == 'quarterly' ? 'selected' : '' ?>>Quarterly</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary mx-2 px-3" style="margin-right: 0.5rem;">Sort</button>
                                </form>
                            </div>
                        
                            <div class="card-body">
                                <?php
                                // Fetch and filter logic
                                $timeframe = isset($_GET['timeframe']) ? validate($_GET['timeframe']) : 'all';
                        
                                // Base query
                                $query = "SELECT 
                                            o.invoice_no, 
                                            o.tracking_no, 
                                            c.fullname, 
                                            p.name AS product_name, 
                                            oi.price AS product_price, 
                                            oi.quantity, 
                                            (oi.price * oi.quantity) AS total, 
                                            o.payment_mode, 
                                            o.order_date
                                          FROM orders o
                                          INNER JOIN customer c ON c.cid = o.customer_id
                                          INNER JOIN order_items oi ON oi.order_id = o.id
                                          INNER JOIN products p ON p.id = oi.product_id";
                        
                                // Filter based on the timeframe
                                $currentDate = date('Y-m-d');
                                switch ($timeframe) {
                                    case 'daily':
                                        $query .= " WHERE DATE(o.order_date) = '$currentDate'";
                                        break;
                                    case 'weekly':
                                        $query .= " WHERE WEEK(o.order_date) = WEEK('$currentDate') AND YEAR(o.order_date) = YEAR('$currentDate')";
                                        break;
                                    case 'monthly':
                                        $query .= " WHERE MONTH(o.order_date) = MONTH('$currentDate') AND YEAR(o.order_date) = YEAR('$currentDate')";
                                        break;
                                    case 'quarterly':
                                        $currentMonth = date('n');
                                        $quarterStart = $currentMonth - (($currentMonth - 1) % 3);
                                        $quarterEnd = $quarterStart + 2;
                                        $query .= " WHERE MONTH(o.order_date) BETWEEN $quarterStart AND $quarterEnd AND YEAR(o.order_date) = YEAR('$currentDate')";
                                        break;
                                    default:
                                        // No additional filter for "all"
                                        break;
                                }
                        
                                $query .= " ORDER BY o.id DESC";
                        
                                $orders = mysqli_query($conn, $query);
                        
                                if ($orders && mysqli_num_rows($orders) > 0) {
                                    ?>
                                    <table class="table table-bordered align-items-center justify-content-center" id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>Invoice No.</th>
                                                <th>Customer Full Name</th>
                                                <th>Product Name</th>
                                                <th>Product Price</th>
                                                <th>Qty</th>
                                                <th>Total</th>
                                                <th>Payment Mode</th>
                                                <th>Order Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($orderItem = mysqli_fetch_assoc($orders)) { ?>
                                                <tr>
                                                    <td class="fw-bold"><?= $orderItem['invoice_no']; ?></td>
                                                    <td><?= $orderItem['fullname']; ?></td>
                                                    <td><?= $orderItem['product_name']; ?></td>
                                                    <td><?= number_format($orderItem['product_price'], 2); ?></td>
                                                    <td><?= $orderItem['quantity']; ?></td>
                                                    <td><?= number_format($orderItem['total'], 2); ?></td>
                                                    <td><?= $orderItem['payment_mode']; ?></td>
                                                    <td><?= date('d M, Y', strtotime($orderItem['order_date'])); ?></td>
                                                    <td>
                                                        <a href="reports-view.php?track=<?= $orderItem['tracking_no']; ?>" class="btn btn-primary mb-2 mt-1 px-2 btn-sm">View</a>
                                                        <a href="reports-view-print.php?track=<?= $orderItem['tracking_no']; ?>" class="btn btn-success mb-2 mt-1 px-2 btn-sm">Print</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <?php
                                } else {
                                    echo "<h5>No Record Available</h5>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

<?php include('includes/footer.php'); ?>
