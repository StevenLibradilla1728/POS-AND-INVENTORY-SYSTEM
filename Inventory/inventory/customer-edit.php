<?php include('includes/header.php'); ?>


<div class="container-fluid">
    <div class="row">
        <!-- Add Category (Center) -->
        <div class="col-md-12 custom-mx">
            <div class="container-fluid bg-white">
                <div class="card mt-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="mb-0">Edit Customer
                            <a href="customer-list.php" class="btn btn-success float-end rounded-5 px-4">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php alertMessage(); ?>
                        <form action="code.php" method="POST">

                            <?php
                            $parmValue = checkParamId('id');
                            if(!is_numeric($parmValue)){
                                echo '<h5>'.$parmValue.'</h5>';
                                return false;
                            }

                            $customer = getById('customers',$parmValue);
                            if($customer['status'] == 200)
                            { 
                            ?>
                            <input type="hidden" name="customerId" value="<?= $customer['data']['id']; ?>">

                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label for="">Name *</label>
                                    <input type="text" name="name" required value="<?= $customer['data']['name']; ?>" class="form-control rounded-5">
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label for="">Email *</label>
                                    <input type="text" name="email" required value="<?= $customer['data']['email']; ?>" class="form-control rounded-5">
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label for="">Phone Number</label>
                                    <input type="text" name="phone" value="<?= $customer['data']['phone']; ?>" class="form-control rounded-5">
                                </div>
                                
                                <div class="col-md-6 mb-2 text-end">
                                    <button type="submit" name="updateCustomer" class="btn btn-success rounded-5 w-25">Update</button>
                                </div>
                            </div>
                            <?php
                            } 
                            else 
                            {
                                echo '<h5>'.$customer['message'].'</h5>';
                                return false;
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
