

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
                    <?php alertMessage(); ?>
                    <div class="p-4">
                        <h3 class="text-dark mb-4 text-center">Login</h3>
                        <form action="login-code.php" method="POST">
                            <div class="mb-3">
                                <label for="email">Enter your Email</label>
                                <input type="email" id="email" name="email" class="form-control rounded-5" required />
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="password">Enter your Password</label>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    class="form-control rounded-5" 
                                    required 
                                    oninput="validatePasswordLength()"
                                />
                                <button 
                                    type="button" 
                                    class="btn btn-lg position-absolute w-20" 
                                    style="top: 1.3rem; right: 1px;" 
                                    onclick="togglePasswordVisibility()">
                                    <i id="toggleIcon" class="bi bi-eye-slash"></i>
                                </button>
                                <div id="passwordError" class="text-danger mt-2" style="display: none;">
                                    Password must be at least 10 characters long.
                                </div>
                            </div>
                            <div class="my-3">
                                <button type="submit" name="loginBtn" class="btn btn-success w-100 mt-2 pt-2 rounded-5">Login</button>
                            </div>
                        </form>
                        <!-- Links for Forgot Password and Sign Up -->
                        <!--<div class="link-btn">
                            <a href="forgot-password.php">Forgot Password?</a>
                        </div>
                        <div class="link-btn">
                            <a href="signup.php">Don't have an account? Sign Up</a>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<script>
function validatePasswordLength() {
    const passwordField = document.getElementById("password");
    const errorMessage = document.getElementById("passwordError");
    
    if (passwordField.value.length < 10) {
        errorMessage.style.display = "block"; // Show error message
    } else {
        errorMessage.style.display = "none"; // Hide error message
    }
}

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



<!--

<?php 
include('includes/header.php');


if(isset($_SESSION['loggedIn'])){
    ?>
    <script>window.location.href = 'index.php';</script>
    <?php
}
?>
<style>
    /*
    .btn-success {
        background: #198754;
        height: 40px;
    }

    .btn-success {
        background: #00BD79;
        color: white;
        
    }
    
    .btn-success:hover {
        background: #00A96A;
        color: white;
        
    }*/

    
    .btn-success {background-image: linear-gradient(to right, #1D976C 0%, #93F9B9  51%, #1D976C  100%)}
         .btn-success {
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
            background-position: right center; /* change the direction of the change here */
            color: #fff;
            text-decoration: none;
          }
         

   

    
</style>
<div class="py-5 bg-white">
    <div class="container mt-4">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card shadow rounded-5 bg-white">

                <?php alertMessage(); ?>
                    <div class="p-4">
                        <h3 class="text-dark mb-4 text-center">Login</h3>
                        <form action="login-code.php" method="POST">
                            <div class="mb-3">
                                <label for="email">Enter your Email</label>
                                <input type="email" id="email" name="email" class="form-control rounded-5" required />
                            </div>
                            <div class="mb-3 position-relative">
                                <label for="password">Enter your Password</label>
                                <input 
                                  type="password" 
                                  id="password" 
                                  name="password" 
                                  class="form-control rounded-5" 
                                  required 
                                  oninput="validatePasswordLength()"
                                />
                                <button 
                                  type="button" 
                                  class="btn btn-lg position-absolute w-20" 
                                  style="top: 1.3rem; right: 1px;" 
                                  onclick="togglePasswordVisibility()">
                                  <i id="toggleIcon" class="bi bi-eye-slash"></i>
                                </button>
                                <div id="passwordError" class="text-danger mt-2" style="display: none;">
                                  Password must be at least 10 characters long.
                                </div>
                              </div>
                            <div class="my-3">
                                <button type="submit" name="loginBtn" class="btn btn-success w-100 mt-2 pt-2 rounded-5">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<script>

function validatePasswordLength() {
    const passwordField = document.getElementById("password");
    const errorMessage = document.getElementById("passwordError");
    
    if (passwordField.value.length < 10) {
      errorMessage.style.display = "block"; // Show error message
    } else {
      errorMessage.style.display = "none"; // Hide error message
    }
  }

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
-->