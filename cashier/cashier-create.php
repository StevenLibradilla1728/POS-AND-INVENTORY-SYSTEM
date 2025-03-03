<?php include('includes/header.php'); ?>


<style>
    .float-end {
        background: #198754;
        color: white;
        border-style: none;
    }

    .shadow {
        background: #198754;
        color: white;
        border-style: none;
    }
    
</style>

<div class="container-fluid px-4">
     <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Add Cashier
                <a href="cashier-list.php" class="btn btn-success float-end rounded-5">Back</a>
            </h4>
        </div>   
        <div class="card-body">
            <?php alertMessage(); ?>
            <form action="code.php" method="POST" enctype="multipart/form-data">
               
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="">Name *</label>
                        <input type="text" name="name" required class="form-control rounded-5">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="">Email *</label>
                        <input type="email" name="email" required class="form-control rounded-5">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="">Password *</label>
                        <input type="password" id="password" name="password" required class="form-control rounded-5">
                        <button type="button" class="btn btn-lg position-absolute w-20" 
                                style="top: 10.4rem; left: 27.7rem;" onclick="togglePasswordVisibility()">
                                <i id="toggleIcon" class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="">Phone Number *</label>
                        <input type="number" name="phone" required class="form-control rounded-5">
                    </div>
                    <div class="col-md-6 mb-4">
                         <label for="">Image *</label>
                         <input type="file" name="image" required class="form-control rounded-5" style="height: 37px;">
                    </div>
                    <div class="col-md-7 mb-2 text-end">
                        <button type="submit" name="saveCashier"class="btn btn-success rounded-5 w-25 shadow">Save</button>
                    </div>
                </div>
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
