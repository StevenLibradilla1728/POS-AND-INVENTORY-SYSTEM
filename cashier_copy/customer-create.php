<?php include('includes/header.php'); ?>


<div class="container-fluid">
    <div class="row">
        <!-- Add Category (Center) -->
        <div class="col-md-12 custom-mx">
            <div class="container-fluid bg-white">
                <div class="card mt-2 shadow-sm">
                    <div class="card-header">
                        <h4 class="mb-0">Add Customer
                            <a href="customer-list.php" class="btn btn-success float-end rounded-5 px-4">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php alertMessage(); ?>
                        <form action="code.php" method="POST">
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label for="">Full Name *</label>
                                    <input type="text" name="name" required class="form-control rounded-5">
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label for="">Email *</label>
                                    <input type="text" name="email" required class="form-control rounded-5">
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label for="">Phone Number</label>
                                    <input type="text" name="phone" class="form-control rounded-5">
                                </div>
                               
                                <div class="col-md-6 mb-2 text-end">
                                    <button type="submit" name="saveCustomer" class="btn btn-success rounded-5 w-25">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
