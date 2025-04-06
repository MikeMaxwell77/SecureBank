<?php
// Include database connection
require_once 'db_connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize
    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    
    // Validate input
    $errors = [];
    
    // Validate username
    if (empty($username)) {
        $errors[] = "Username is required";
    } elseif (strlen($username) < 5) {
        $errors[] = "Username must be at least 5 characters";
    }
    
    // Validate password
    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters";
    } elseif (!preg_match("/[A-Z]/", $password)) {
        $errors[] = "Password must contain at least one uppercase letter";
    } elseif (!preg_match("/[a-z]/", $password)) {
        $errors[] = "Password must contain at least one lowercase letter";
    } elseif (!preg_match("/[0-9]/", $password)) {
        $errors[] = "Password must contain at least one number";
    } elseif (!preg_match("/[!@#$%^&*(),.?\":{}|<>]/", $password)) {
        $errors[] = "Password must contain at least one special character";
    }
    
    // Validate password confirmation
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match";
    }
    
    // Check if username already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $errors[] = "Username already exists";
    }
    $stmt->close();
    
    // If no errors, insert user into database
    if (empty($errors)) {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);
        
        // Execute statement
        if ($stmt->execute()) {
            // Redirect to login page
            header("Location: Home-Login.php?registration=success");
            exit();
        } else {
            $errors[] = "Error: " . $stmt->error;
        }
        
        $stmt->close();
    }
        // After successful database insertion
    if ($registration_successful) {
        // Set success message in session if needed
        $_SESSION['registration_success'] = true;
        
        // Redirect to success page or login page
        header("Location: Home-Login.php");
        exit();
    } else {
        // Handle errors
        $_SESSION['registration_errors'] = $errors;
        $_SESSION['registration_data'] = $_POST;
        header("Location: register.php");
        exit();
    }
}

// Close connection
$conn->close();
?>