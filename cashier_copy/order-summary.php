<?php include('includes/header.php'); 
if(!isset($_SESSION['productItems']))
{
    echo '<script> window.location.href = "order-create.php"; </script>';
}
?>

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
    font-weight: 600;
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



<div class="modal fade mt-3" id="orderSuccessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
         
      <div class="mb-3 p-4">
        <h5 id="orderPlacedSuccessMessage"></h5>
      </div>
      <div class="modal-footer">
        <a href="orders.php" class="btn btn-secondary">Close</a>
        <button type="button" onclick="printMyBillingArea()" class="btn btn-success">Print</button>
        <button type="button" onclick="downloadPDF('<?= $_SESSION['invoice_no']; ?>')" class="btn btn-primary">Download</button>
      </div>
    </div>
  </div>
</div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 custom-mx">
            <div class="container-fluid bg-white">
                <div class="card mt-3 shadow-sm">
                    <div class="card-header">
                        <h4 class="mb-0">Order Summary
                            <a href="order-create.php" class="btn btn-success float-end rounded-5 px-4">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php alertMessage(); ?>

                        
                        <div id="myBillingArea">
                        <?php
                            if (isset($_SESSION['cphone'])) {
                                $phone = validate($_SESSION['cphone']);
                                $invoiceNo = validate($_SESSION['invoice_no']);
                            
                                // Query to fetch customer details along with the room number
                                $customerQuery = mysqli_query($conn, "
                                    SELECT customer.*, reservation.room_no 
                                    FROM customer 
                                    LEFT JOIN reservation ON customer.cid = reservation.id 
                                    WHERE customer.phone = '$phone' 
                                    LIMIT 1
                                ");
                            
                                if ($customerQuery) {
                                    if (mysqli_num_rows($customerQuery) > 0) {
                                        $cRowData = mysqli_fetch_assoc($customerQuery);
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
                                                        <p>Customer Full Name: <?= $cRowData['fullname'] ?></p>
                                                        <p>Customer Phone No.: <?= $cRowData['phone'] ?></p>
                                                        <p>Customer Email: <?= $cRowData['email'] ?></p>
                                                    </td>
                                                    <td class="invoice-details">
                                                        <h5>Invoice Details</h5>
                                                        <p>Invoice No: <?= $invoiceNo; ?></p>
                                                        <p>Invoice Date: <?= date('d M Y'); ?></p>
                                                        <p>Room No.: <?= $cRowData['room_no'] ? $cRowData['room_no'] : 'N/A'; ?></p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <?php
                                    } else {
                                        echo '<h5>No Customer Found</h5>';
                                        return;
                                    }
                                }
                            }
                            ?>
                            <?php 
                            if(isset($_SESSION['productItems']))
                            {
                                $sessionProducts = $_SESSION['productItems'];
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
                                              $totalAmount = 0;

                                              foreach($sessionProducts as $key => $row) :

                                              $totalAmount += $row['price'] * $row['stock_level']
                                            ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $row['name']; ?></td>
                                                <td><?= number_format($row['price'], 0) ?></td>
                                                <td><?= $row['stock_level'] ?></td>
                                                <td class="fw-bold"><?= number_format($row['price'] * $row['stock_level'], 0) ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td colspan="4" class="grand-total-label border-bottom-0">Grand Total:</td>
                                                <td class="fw-bold border-bottom-0"><?= number_format($totalAmount, 0); ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="pt-2 pb-2">Payment Mode: <?= $_SESSION['payment_mode'];?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                                
                            }
                            else
                            {
                                echo '<h5 class="text-center">No Items added</h5>';
                            }
                            ?>
                        </div>

                        <?php if(isset($_SESSION['productItems'])) : ?>
                        <div class="mt-4 text-end">
                           <button type="button" class="btn btn-primary px-4 mx-1" id="saveOrder">Confirm Order</button>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
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

<?php include('includes/footer.php'); ?>