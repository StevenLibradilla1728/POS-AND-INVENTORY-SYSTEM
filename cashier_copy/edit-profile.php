<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Edit Profile
                <a href="index.php" class="btn btn-success float-end">Back</a>
            </h4>
        </div>   
        <div class="card-body">
            <?php alertMessage(); ?>
            <form action="code.php" method="POST" enctype="multipart/form-data">
                <?php 
                    // Ensure the logged-in user is available in the session
                    if (isset($_SESSION['loggedInUser']['id'])) {
                        $cashierId = $_SESSION['loggedInUser']['id'];

                        // Fetch the cashier data from the database
                        $cashierData = getById('cashiers', $cashierId); // Replace 'cashiers' with the correct table name
                        
                        if ($cashierData && $cashierData['status'] == 200) {
                            ?>
                            <input type="hidden" name="cashierId" value="<?= $cashierData['data']['id']; ?>">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="">Name *</label>
                                    <input type="text" name="name" required value="<?= $cashierData['data']['name']; ?>" class="form-control rounded-5">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="">Email *</label>
                                    <input type="email" name="email" required value="<?= $cashierData['data']['email']; ?>" class="form-control rounded-5">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="password">Enter your Password</label>
                                    <input type="password" id="password" name="password" class="form-control rounded-5" required />
                                    <button type="button" class="btn btn-lg position-absolute w-20" 
                                            style="top: 10.4rem; left: 27.7rem;" onclick="togglePasswordVisibility()">
                                        <i id="toggleIcon" class="bi bi-eye-slash"></i>
                                    </button>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="">Phone Number *</label>
                                    <input type="number" name="phone" required value="<?= $cashierData['data']['phone']; ?>" class="form-control rounded-5">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="">Image *</label>
                                    <input type="file" name="image" class="form-control rounded-5" style="height: 37px;">
                                    <!-- Display current image -->
                                    <img src="./<?= $cashierData['data']['image']; ?>" style="width: 40px;height: 40px;border-radius:50%;" alt="Profile Picture" />
                                </div>
                                <div class="col-md-7 mb-2 text-end">
                                    <button type="submit" name="updateCashierProfile" class="btn btn-success rounded-5 w-25">Update</button>
                                </div>
                            </div>
                            <?php
                        } else {
                            echo '<h5>User data not found or invalid!</h5>';
                        }
                    } else {
                        echo '<h5>User not logged in or session expired!</h5>';
                    }
                ?>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<script>
    function togglePasswordVisibility() {
        var passwordField = document.getElementById("password");
        var toggleIcon = document.getElementById("toggleIcon");
        
        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleIcon.classList.remove("bi-eye-slash");
            toggleIcon.classList.add("bi-eye");
        } else {
            passwordField.type = "password";
            toggleIcon.classList.remove("bi-eye");
            toggleIcon.classList.add("bi-eye-slash");
        }
    }
</script>

<!-- Add Bootstrap Icons for the eye icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">