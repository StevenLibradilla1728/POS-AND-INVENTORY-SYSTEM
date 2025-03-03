<?php 
require 'config/function.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['loginBtn'])) {
    if (!isset($conn)) {
        die("Database connection error!");
    }

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        // Use prepared statement to prevent SQL injection
        $query = "SELECT * FROM cashiers WHERE email = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $hashedPassword = $row['password'];
                $role = $row['role']; // Fetch user role

                if (password_verify($password, $hashedPassword)) {
                    // Store user data in session
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['loggedInUser'] = [
                        'user_id' => $row['id'],
                        'image' => $row['image'],
                        'name' => $row['name'],
                        'email' => $row['email'],
                        'phone' => $row['phone'],
                        'role' => $role
                    ];

                    // Redirect based on user role
                    if ($role == 'admin') {
                        redirect('Inventory/inventory/index.php', 'Welcome Admin');
                    } elseif ($role == 'cashier') {
                        redirect('cashier/index.php', 'Welcome Cashier');
                    } else {
                        redirect('login.php', 'Unauthorized Access');
                    }
                } else {
                    redirect('login.php', 'Invalid Password');
                }
            } else {
                redirect('login.php', 'Invalid Email Address');
            }
        } else {
            redirect('login.php', 'Query Error!');
        }
    } else {
        redirect('login.php', 'All fields are required!');
    }
}
?>
