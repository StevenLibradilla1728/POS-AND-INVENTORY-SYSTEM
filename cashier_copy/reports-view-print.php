<?php include('includes/header.php'); ?>

<style>
    .modal-backdrop.show {
    z-index: 1050;
    }
    .invoice-table {
    width: 100%;
    margin-bottom: 20px;
    }

    .invoice-table h4 {
    font-size: 23px;
    line-height: 30px;
    margin: 2px;
    }

    .invoice-table p {
    font-size: 16px;
    line-height: 24px;
    margin: 2px;
    margin-bottom: 1.5rem;
    }

    .customer-details {
    text-align: left;
    }

    .customer-details h5 {
    text-align: left;
    font-size: 20px;
    line-height: 30px;
    margin: 0;
    }

   .invoice-details h5 {
    font-size: 20px;
    line-height: 30px;
    margin: 0;
    }

    .customer-details p {
    text-align: left;
    font-size: 14px;
    line-height: 20px;
    margin: 0;
    }

    .invoice-details p {
    font-size: 14px;
    line-height: 20px;
    margin: 0;
    }

    .company-info,
    .customer-details,
    .invoice-details {
    padding: 0;
    text-align: center;
    }

    .invoice-details {
    text-align: right;
    }

    .product-table {
    width: 100%;
    border-collapse: collapse;
    }

    .product-table th,
    .product-table td {
    padding: 5px;
    border-bottom: 1px solid #ccc;
    text-align: start;
    }

    .product-table .grand-total-label {
    text-align: right;
    font-weight: bold;
    }

    .product-table .fw-bold {
    font-weight: bold;
    }
</style>

<div class="container-fluid bg-white">
    <div class="card mt-3 shadow-sm col-md-11" style="margin: 0 1.2rem;">
        <div class="card-header bg-white">
            <h4 class="mb-0">Print Sales
            <a href="reports.php" class="btn btn-success float-end rounded-5 px-4">Back</a>
            </h4>
        </div>
        <div class="card-body">

            <div id="myBillingArea">
                <?php 
                 if (isset($_GET['track'])) {
                    $trackingNo = validate($_GET['track']);
                    if ($trackingNo == '') {
                        ?>
                        <div class="text-center py-5">
                            <h5>Please Provide Tracking Number</h5>
                            <div>
                                <a href="orders.php" class="btn btn-success">Go back to orders</a>
                            </div>
                        </div>
                        <?php
                        return;
                    }
                
                    // Updated query to include room_no from the reservation table
                    $orderQuery = "
                        SELECT o.*, c.*, r.room_no 
                        FROM orders o
                        INNER JOIN customer c ON c.cid = o.customer_id
                        LEFT JOIN reservation r ON r.id = c.cid
                        WHERE o.tracking_no = '$trackingNo' 
                        LIMIT 1
                    ";
                    
                    $orderQueryRes = mysqli_query($conn, $orderQuery);
                    if (!$orderQueryRes) {
                        echo "<h5>Something Went Wrong</h5>";
                        return false;
                    }
                
                    if (mysqli_num_rows($orderQueryRes) > 0) {
                        $orderDataRow = mysqli_fetch_assoc($orderQueryRes);
                        ?>
                        <table class="invoice-table">
                            <tbody>
                                <tr>
                                    <td colspan="2" class="company-info">
                                        <h4>Trees Residences</h4>
                                        <p>P3P8+PC2, 16 St Matthew, Novaliches, Quezon City, Metro Manila</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="customer-details">
                                        <h5>Customer Details</h5>
                                        <p>Customer Full Name: <?= $orderDataRow['fullname'] ?></p>
                                        <p>Customer Phone No.: <?= $orderDataRow['phone'] ?></p>
                                        <p>Customer Email: <?= $orderDataRow['email'] ?></p>
                                    </td>
                                    <td class="invoice-details">
                                        <h5>Invoice Details</h5>
                                        <p>Invoice No: <?= $orderDataRow['invoice_no']; ?></p>
                                        <p>Invoice Date: <?= date('d M, Y', strtotime($orderDataRow['order_date'])); ?></p>
                                        <p>Room No.: <?= $orderDataRow['room_no'] ? $orderDataRow['room_no'] : 'N/A'; ?></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php
                    } else {
                        echo "<h5>No data found</h5>";
                        return false;
                    }

                    $orderItemQuery = "SELECT oi.quantity as orderItemStock_Level, oi.price as orderItemPrice, o.*, oi.*, p.* FROM orders o, order_items oi, products p 
                    WHERE oi.order_id=o.id AND p.id=oi.product_id AND o.tracking_no='$trackingNo' ";

                    $orderItemQueryRes = mysqli_query($conn, $orderItemQuery);
                    if($orderItemQueryRes)
                    {
                        if(mysqli_num_rows($orderItemQueryRes) > 0)
                        {
                            ?>
                            <div class="table-responsive shadow-sm mb-2 rounded-2">
                                <table class="product-table table-borderless border-0">
                                    <thead>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th>Product Name</th>
                                            <th width="10%">Price</th>
                                            <th width="10%">Qty</th>
                                            <th width="15%">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                          $i = 1;
                                          foreach($orderItemQueryRes as $key => $row) :

                                        ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $row['name']; ?></td>
                                            <td><?= number_format($row['orderItemPrice'], 0) ?></td>
                                            <td><?= $row['orderItemStock_Level'] ?></td>
                                            <td class="fw-bold"><?= number_format($row['orderItemPrice'] * $row['orderItemStock_Level'], 0) ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td colspan="4" class="grand-total-label border-bottom-0">Grand Total:</td>
                                            <td class="fw-bold border-bottom-0"><?= number_format($row['total_amount'], 0); ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="pt-2 pb-2">Payment Mode: <?= $row['payment_mode'];?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <?php

                        }
                        else
                        {
                            echo "<h5>No data found</h5>";
                            return false;
                        }

                    }
                    else
                    {
                        echo "<h5>Something Went Wrong</h5>";
                        return false;
                    }
                    }
                    else
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

            <div class="mt-3 text-end">
                <button class="btn btn-success px-2 mx-1" onclick="printMyBillingArea()">Print</button>
                <button class="btn btn-danger px-2 mx-1" onclick="downloadPDF('<?= $orderDataRow['invoice_no']; ?>')">Download PDF</button>
            </div>

        </div>
    </div>
</div>





<script>
    //Print Function
    function printMyBillingArea() {
        var divContents = document.getElementById("myBillingArea").innerHTML;
        var a = window.open('', '');
        a.document.write('<html><head><title></title>');
        
        // Include Bootstrap CSS
        a.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">');
        
        // Add internal styles
        a.document.write('<style>');
        a.document.write(`
        .invoice-table {
            width: 100%;
            margin-bottom: 20px;
            }
        
            .invoice-table h4 {
            font-size: 23px;
            line-height: 30px;
            margin: 2px;
            }
        
            .invoice-table p {
            font-size: 16px;
            line-height: 24px;
            margin: 2px;
            }
        
            .customer-details {
            text-align: left;
            }
        
            .customer-details h5 {
            text-align: left;
            font-size: 20px;
            line-height: 30px;
            margin: 0;
            }
        
           .invoice-details h5 {
            font-size: 20px;
            line-height: 30px;
            margin: 0;
            }
        
            .customer-details p {
            text-align: left;
            font-size: 14px;
            line-height: 20px;
            margin: 0;
            }
        
            .invoice-details p {
            font-size: 14px;
            line-height: 20px;
            margin: 0;
            }
        
            .company-info,
            .customer-details,
            .invoice-details {
            padding: 0;
            text-align: center;
            }
        
            .invoice-details {
            text-align: right;
            }
        
            .product-table {
            width: 100%;
            border-collapse: collapse;
            }
        
            .product-table th,
            .product-table td {
            padding: 5px;
            border-bottom: 1px solid #ccc;
            text-align: start;
            }
        
            .product-table .grand-total-label {
            text-align: right;
            font-weight: bold;
            }
        
            .product-table .fw-bold {
            font-weight: bold;
            }
            
        `);
        a.document.write('</style></head><body>');
        
        // Write the content to the document
        a.document.write(divContents);
        a.document.write('</body></html>');
        a.document.close();
        a.print();
    }


    async function downloadPDF(invoiceNo) {
      // Ensure jsPDF is loaded correctly
      const { jsPDF } = window.jspdf;

      // Initialize jsPDF instance
      const docPDF = new jsPDF();

      // Target the HTML element to render
      const elementHTML = document.querySelector("#myBillingArea");

      // Use the html() method to render HTML into the PDF
      await docPDF.html(elementHTML, {
        callback: function (doc) {
          // Save the PDF
          doc.save(invoiceNo + '.pdf');
        },
        x: 15,
        y: 15,
        width: 175, // Adjust width as needed
        windowWidth: 500 // Capture full element width
      });
    }

    


</script>



<!--<script>
    function printMyBillingArea() {
    
    var divContents = document.getElementById("myBillingArea").innerHTML;
    var a = window.open('', '');
    a.document.write('<html><title>POS SYSTEM</title>');
    a.document.write('<body style="font-family: fangsong;">');
    a.document.write(divContents);
    a.document.write('</body></html>');
    a.document.close();
    a.print();

}
</script>-->
<?php include('includes/footer.php'); ?>

