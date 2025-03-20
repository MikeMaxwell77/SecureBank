php
 Start session
session_start();

 Include database connection
require_once 'db_connect.php';

 Check if form is submitted
if ($_SERVER[REQUEST_METHOD] == POST) {
     Get form data
    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password'];
    
     Validate input
    if (empty($username)  empty($password)) {
        header(Location login.phperror=empty);
        exit();
    }
    
     Prepare SQL statement
    $stmt = $conn-prepare(SELECT id, username, password, full_name FROM users WHERE username = );
    $stmt-bind_param(s, $username);
    $stmt-execute();
    $result = $stmt-get_result();
    
     Check if user exists
    if ($result-num_rows == 1) {
        $user = $result-fetch_assoc();
        
         Verify password
        if (password_verify($password, $user['password'])) {
             Password is correct, create session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['loggedin'] = true;
            
             Redirect to dashboard or home page
            header(Location dashboard.php);
            exit();
        } else {
             Password is incorrect
            header(Location login.phperror=invalid);
            exit();
        }
    } else {
         Username doesn't exist
        header(Location login.phperror=invalid);
        exit();
    }
    
    $stmt-close();
}

 Close connection
$conn-close();
