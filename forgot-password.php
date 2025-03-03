<?php
include('includes/header.php');

if (isset($_SESSION['loggedIn'])) {
    echo "<script>window.location.href = 'index.php';</script>";
}
?>
<div class="py-5 bg-white">
    <div class="container mt-4">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card shadow rounded-5 bg-white">
                    <div class="p-4">
                        <h3 class="text-dark mb-4 text-center">Forgot Password</h3>
                        <form action="forgot-password-code.php" method="POST">
                            <div class="mb-3">
                                <label for="email">Enter your Email</label>
                                <input type="email" id="email" name="email" class="form-control rounded-5" required />
                            </div>
                            <div class="my-3">
                                <button type="submit" name="forgotPasswordBtn" class="btn btn-success w-100 mt-2 pt-2 rounded-5">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>