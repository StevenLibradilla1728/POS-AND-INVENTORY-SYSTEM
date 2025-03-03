

<?php 
include('includes/header.php');

if(isset($_SESSION['loggedIn'])){
    ?>
    <script>window.location.href = 'index.php';</script>
    <?php
}
?>
<style>
    .btn-success {
        background-image: linear-gradient(to right, #1D976C 0%, #93F9B9 51%, #1D976C 100%);
        margin-left: 0;
        padding: 15px 45px;
        text-align: center;
        border: 0px;
        font-weight: 700;
        font-size: 1.1rem;
        transition: 0.5s;
        height: 2.6rem;
        background-size: 200% auto;
        color: white;
        box-shadow: 0 0 20px #eee;
        border-radius: 10px;
        display: block;
    }

    .btn-success:hover {
        background-position: right center;
        color: #fff;
        text-decoration: none;
    }

    .link-btn {
        text-align: center;
        margin-top: 10px;
    }

    .link-btn a {
        color: #198754;
        text-decoration: none;
        font-weight: 500;
    }

    .link-btn a:hover {
        text-decoration: underline;
    }
</style>
<div class="py-5 bg-white">
    <div class="container mt-4">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card shadow rounded-5 bg-white">
                    <div class="p-4">
                        <h3 class="text-dark mb-4 text-center">Sign Up</h3>
                        <form action="signup-code.php" method="POST">
                            <div class="mb-3">
                                <label for="name">Enter your Name</label>
                                <input type="text" id="name" name="name" class="form-control rounded-5" required />
                            </div>
                            <div class="mb-3">
                                <label for="phone">Enter your Phone</label>
                                <input type="text" id="phone" name="phone" class="form-control rounded-5" required />
                            </div>
                            <div class="mb-3">
                                <label for="email">Enter your Email</label>
                                <input type="email" id="email" name="email" class="form-control rounded-5" required />
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="password">Create Password</label>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    class="form-control rounded-5" 
                                    required 
                                    oninput="validatePassword()"
                                />
                                <button 
                                    type="button" 
                                    class="btn btn-lg position-absolute" 
                                    style="top: 1.3rem; right: 1px;" 
                                    onclick="togglePasswordVisibility('password', 'toggleIcon1')">
                                    <i id="toggleIcon1" class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="confirm_password">Confirm Password</label>
                                <input 
                                    type="password" 
                                    id="confirm_password" 
                                    name="confirm_password" 
                                    class="form-control rounded-5" 
                                    required 
                                    oninput="validatePassword()"
                                />
                                <button 
                                    type="button" 
                                    class="btn btn-lg position-absolute" 
                                    style="top: 1.3rem; right: 1px;" 
                                    onclick="togglePasswordVisibility('confirm_password', 'toggleIcon2')">
                                    <i id="toggleIcon2" class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                            <div id="passwordError" class="text-danger mt-2" style="display: none;">
                                Passwords must match and be at least 10 characters long.
                            </div>
                            <div class="my-3">
                                <button type="submit" name="signupBtn" class="btn btn-success w-100 mt-2 pt-2 rounded-5">Sign Up</button>
                            </div>
                        </form>
                        <!-- Link to Login Page -->
                        <div class="link-btn">
                            <a href="login.php">Already have an account? Log In</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<script>
function validatePassword() {
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm_password").value;
    const errorMessage = document.getElementById("passwordError");

    if (password.length < 10 || confirmPassword.length < 10 || password !== confirmPassword) {
        errorMessage.style.display = "block"; // Show error message
    } else {
        errorMessage.style.display = "none"; // Hide error message
    }
}

function togglePasswordVisibility(fieldId, iconId) {
    const passwordField = document.getElementById(fieldId);
    const toggleIcon = document.getElementById(iconId);
    
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




<!--<?php 
include('includes/header.php');

if(isset($_SESSION['loggedIn'])){
    ?>
    <script>window.location.href = 'index.php';</script>
    <?php
}
?>
<style>
    .btn-success {
        background-image: linear-gradient(to right, #1D976C 0%, #93F9B9 51%, #1D976C 100%);
        margin-left: 0;
        padding: 15px 45px;
        text-align: center;
        border: 0px;
        font-weight: 700;
        font-size: 1.1rem;
        transition: 0.5s;
        height: 2.6rem;
        background-size: 200% auto;
        color: white;
        box-shadow: 0 0 20px #eee;
        border-radius: 10px;
        display: block;
    }

    .btn-success:hover {
        background-position: right center;
        color: #fff;
        text-decoration: none;
    }

    .link-btn {
        text-align: center;
        margin-top: 10px;
    }

    .link-btn a {
        color: #198754;
        text-decoration: none;
        font-weight: 500;
    }

    .link-btn a:hover {
        text-decoration: underline;
    }
</style>
<div class="py-5 bg-white">
    <div class="container mt-4">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card shadow rounded-5 bg-white">
                    <div class="p-4">
                        <h3 class="text-dark mb-4 text-center">Sign Up</h3>
                        <form action="signup-code.php" method="POST">
                            <div class="mb-3">
                                <label for="email">Enter your Email</label>
                                <input type="email" id="email" name="email" class="form-control rounded-5" required />
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="password">Create Password</label>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    class="form-control rounded-5" 
                                    required 
                                    oninput="validatePassword()"
                                />
                                <button 
                                    type="button" 
                                    class="btn btn-lg position-absolute" 
                                    style="top: 1.3rem; right: 1px;" 
                                    onclick="togglePasswordVisibility('password', 'toggleIcon1')">
                                    <i id="toggleIcon1" class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="confirm_password">Confirm Password</label>
                                <input 
                                    type="password" 
                                    id="confirm_password" 
                                    name="confirm_password" 
                                    class="form-control rounded-5" 
                                    required 
                                    oninput="validatePassword()"
                                />
                                <button 
                                    type="button" 
                                    class="btn btn-lg position-absolute" 
                                    style="top: 1.3rem; right: 1px;" 
                                    onclick="togglePasswordVisibility('confirm_password', 'toggleIcon2')">
                                    <i id="toggleIcon2" class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                            <div id="passwordError" class="text-danger mt-2" style="display: none;">
                                Passwords must match and be at least 10 characters long.
                            </div>
                            <div class="my-3">
                                <button type="submit" name="signupBtn" class="btn btn-success w-100 mt-2 pt-2 rounded-5">Sign Up</button>
                            </div>
                        </form>
                        <!-- Link to Login Page -->
                        <div class="link-btn">
                            <a href="login.php">Already have an account? Log In</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<script>
function validatePassword() {
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm_password").value;
    const errorMessage = document.getElementById("passwordError");

    if (password.length < 10 || confirmPassword.length < 10 || password !== confirmPassword) {
        errorMessage.style.display = "block"; // Show error message
    } else {
        errorMessage.style.display = "none"; // Hide error message
    }
}

function togglePasswordVisibility(fieldId, iconId) {
    const passwordField = document.getElementById(fieldId);
    const toggleIcon = document.getElementById(iconId);
    
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
-->