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
            <h4 class="mb-0">Customer List
                <a href="customer-create.php" class="btn btn-success float-end rounded-5">Add Customer</a>
            </h4>
        </div>   
        <div class="card-body">

        <?php alertMessage(); ?>

        <?php
            /*$limit = 4;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $start = ($page > 1) ? ($page * $limit) - $limit : 0;

            $totalCustomers = getAll('customers');
            $totalCount = mysqli_num_rows($totalCustomers);
            $totalPages = ceil($totalCount / $limit);*/

            $customers = getAll('customers');
            if (!$customers) {
                echo '<h4>Something Went Wrong!</h4>';
                return false;
            }
            if (mysqli_num_rows($customers) > 0) {
            ?>

            <div class="table-responsive shadow-sm rounded-2">
                <table class="table table-bordered" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                          
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        <?php foreach($customers as $item) : ?>
                        <tr>
                            <td><?php echo $item['id'] ?></td>
                            <td><?php echo $item['name'] ?></td>
                            <td><?php echo $item['email'] ?></td>
                            <td><?php echo $item['phone'] ?></td>
                           
                            <td>
                                
                                <a href="customer-edit.php?id=<?php echo $item['id']; ?>" class="btn btn-success btn-sm mx-1">Edit</a>
                                <button onclick="confirmDelete2(<?php echo $item['id']; ?>)" class="btn btn-danger btn-sm mx-1">Delete</button>                             
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!--<nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mt-3">
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <li class="page-item <?php echo ($page === $i) ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>-->

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
