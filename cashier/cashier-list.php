<?php include('includes/header.php'); ?>

<style>
    /*
    .float-end {
        background: #198754;
        color: white;
        border-style: none;
    }

    .float-end:hover {
        background: #1e7e34;
        color: white;
        border-style: none;
    }*/

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
            <h4 class="mb-0">Cashier List
                <!--<a href="cashier-create.php" class="btn btn-success float-end rounded-5">Add Cashier</a>-->
            </h4>
        </div>   
        <?php
    // Pagination Setup
    //$limit = 4; // Number of records per page
    //$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    //$start = ($page > 1) ? ($page * $limit) - $limit : 0;

    // Fetch total cashiers count for pagination
    //$totalCashiers = getAll("users", "WHERE role = 'cashier'");
    //$totalCount = ($totalCashiers) ? mysqli_num_rows($totalCashiers) : 0;
    //$totalPages = ($totalCount > 0) ? ceil($totalCount / $limit) : 1;

    // Fetch only `cashier` role users with pagination
    $cashiers = getAll("cashiers", "WHERE role = 'cashier' LIMIT 7"); // Set a limit


    if (!$cashiers) {
        echo '<h4>Something Went Wrong!</h4>';
        return;
    }

    if (mysqli_num_rows($cashiers) > 0): ?>
        <div class="table-responsive shadow-sm rounded-2">
            <table class="table table-bordered" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($cashierItem = mysqli_fetch_assoc($cashiers)) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($cashierItem['id']); ?></td>
                            <td class="p-0 m-0">
                                <img src="<?php echo htmlspecialchars($cashierItem['image']); ?>"  
                                     class="px-0 rounded-2 align-items-center justify-content-center" 
                                     alt="Cashier Image" style="width:50px;height:60px;margin-left:20px;">
                            </td>
                            <td><?php echo htmlspecialchars($cashierItem['name']); ?></td>
                            <td><?php echo htmlspecialchars($cashierItem['email']); ?></td>
                            <td><?php echo htmlspecialchars($cashierItem['phone']); ?></td>
                            <td>
                                <a href="cashier-edit.php?id=<?php echo htmlspecialchars($cashierItem['id']); ?>" 
                                   class="btn btn-success btn-sm mx-1 px-3 my-2">Edit</a>
                                <button onclick="confirmDelete(<?php echo htmlspecialchars($cashierItem['id']); ?>)" 
                                        class="btn btn-danger btn-sm my-2">Delete</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <!--<nav aria-label="Page navigation">
            <ul class="pagination justify-content-center mt-3">
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?php echo ($page === $i) ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>-->

    <?php else: ?>
        <h4 class="mb-0">No Cashiers Found</h4>
    <?php endif; ?>
</div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure you want to delete this cashier?',
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
                window.location.href = "cashier-delete.php?id=" + id;
            }
        });
    }
</script>

<?php include('includes/footer.php'); ?>

