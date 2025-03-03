<?php 

require 'config/function.php';

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['signupBtn'])) {
    $name = validate($_POST['name']);
    $phone = validate($_POST['phone']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $confirm_password = validate($_POST['confirm_password']);

    // Ensure all fields are filled
    if ($name != '' && $phone != '' && $email != '' && $password != '' && $confirm_password != '') {
        // Ensure password and confirm password match
        if ($password === $confirm_password) {
            // Ensure password meets minimum length requirement
            if (strlen($password) >= 10) {
                // Check if the email is already registered
                $query = "SELECT * FROM cashiers WHERE email='$email' LIMIT 1";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    if (mysqli_num_rows($result) == 0) {
                        // Hash the password before storing it
                        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                        // Insert new user into the database
                        $insertQuery = "INSERT INTO cashiers (name, phone, email, password) VALUES ('$name', '$phone', '$email', '$hashedPassword')";
                        $insertResult = mysqli_query($conn, $insertQuery);

                        if ($insertResult) {
                            // Registration successful
                            redirect('cashier/index.php', 'Account created successfully!');
                        } else {
                            // Database insertion error
                            redirect('signup.php', 'Something went wrong while creating your account!');
                        }
                    } else {
                        // Email already exists
                        redirect('signup.php', 'Email is already registered. Please use another email.');
                    }
                } else {
                    // Query execution error
                    redirect('signup.php', 'Something went wrong!');
                }
            } else {
                // Password length error
                redirect('signup.php', 'Password must be at least 10 characters long.');
            }
        } else {
            // Passwords do not match
            redirect('signup.php', 'Passwords do not match.');
        }
    } else {
        // Missing required fields
        redirect('signup.php', 'All fields are required!');
    }
}