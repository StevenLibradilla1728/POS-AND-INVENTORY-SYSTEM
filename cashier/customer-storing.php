<?php include('includes/header.php'); ?>

<style>
    .pagination .page-link {
        border: #198754;
        background: #198754;
        color: #fff;
    }

    .custom-swal-popup {
        width: 420px;
        height: 340px; 
        padding: 0.5rem;
        border-radius: 40px;
        font-size: 13px;
    }
</style>

<div class="container-fluid px-4">
    <div class="card mt-2 shadow-sm">
        <div class="card-header bg-white">
            <h4 class="mb-0">Ordering Customers
                <!--<a href="customer-create.php" class="btn btn-success float-end rounded-5">Add Customer</a>-->
            </h4>
        </div>   
        <div class="card-body">

            <?php alertMessage(); ?>

            <?php
                // SQL query to get the customer data based on orders
                $query = "SELECT o.*, c.*, o.order_date FROM orders o JOIN customer c ON c.cid = o.customer_id";
                $query_run = mysqli_query($conn, $query);

                if (!$query_run) {
                    echo '<h4>Something Went Wrong!</h4>';
                    return false;
                }

                if (mysqli_num_rows($query_run) > 0) {
            ?>

            <div class="table-responsive shadow-sm rounded-2">
                <table class="table table-bordered" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Order Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($item = mysqli_fetch_assoc($query_run)) : ?>
                        <tr>
                            <td><?php echo $item['id'] ?></td> <!-- Assuming order_id is in orders table -->
                            <td><?php echo $item['customer_id'] ?></td>
                            <td><?php echo $item['fullname'] ?></td>
                            <td><?php echo $item['email'] ?></td>
                            <td><?php echo $item['phone'] ?></td>
                            <td><?= date('d M, Y', strtotime($item['order_date'])); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <?php
                } else {
                    echo '<h4 class="mb-0">No Record found</h4>';
                }
            ?>
        </div>
     </div>
</div>

<script>
    function confirmDelete2(id) {
        Swal.fire({
            title: 'Are you sure you want to delete this customer?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            customClass: {
                popup: 'custom-swal-popup' // Add a custom class to the popup
            },
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "customer-delete.php?id=" + id;
            }
        });
    }
</script>

<?php include('includes/footer.php'); ?>