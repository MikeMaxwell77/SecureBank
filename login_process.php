<?php
// Start session
session_start();
// Error logging function
function logError($message) {
    error_log(date('[Y-m-d H:i:s]') . " Login error: " . $message . "\n", 3, "login_errors.log");
}

// Handle errors
$error = "";
if (isset($_GET['error'])) {
    switch($_GET['error']) {
        case 'empty':
            $error = "Username and password required";
            break;
        case 'invalid':
            $error = "Invalid username or password";
            logError("Failed login attempt for username: " . 
            //questionable
                     (isset($_POST['username']) ? ($_POST['username']) : 'not provided'));
            break;
        default:
            $error = "An error occurred";
    }
}
// Include database connection
require_once 'db_connect.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Validate input
    if (empty($username) || empty($password)) {
        header("Location: Home-Login.php?error=empty");
        exit();
    }
    
    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT id, username, password_hash, full_name FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if user exists
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password_hash'])) {
            // Password is correct, create session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            //$_SESSION['full_name'] = $user['full_name'];
            $_SESSION['loggedin'] = true;
            
            // Redirect to dashboard or home page
            header("Location: transfer page.php");
            exit();
        } else {
            // Password is incorrect
            header("Location: Home-Login.php?error=invalid");
            exit();
        }
    } else {
        // Username doesn't exist
        header("Location: Home-Login.php?error=invalid");
        exit();
    }
    
    $stmt->close();
}

// Close connection
$conn->close();
?>