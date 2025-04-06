<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecureBank - CTF Challenge</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #2c3e50;
            color: white;
            padding: 1rem;
            text-align: center;
        }
        nav {
            background-color: #34495e;
            padding: 0.5rem;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }
        nav li {
            margin: 0 1rem;
        }
        nav a {
            color: white;
            text-decoration: none;
            padding: 0.5rem;
        }
        nav a:hover {
            background-color: #2c3e50;
            border-radius: 4px;
        }
        main {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .login-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 400px;
            margin: 0 auto;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }
        button:hover {
            background-color: #2980b9;
        }
        footer {
            text-align: center;
            padding: 1rem;
            background-color: #2c3e50;
            color: white;
            margin-top: 2rem;
        }
        .account-overview {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin-top: 2rem;
        }
        .account-card {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        .hidden {
            display: none;
        }
        .login-response {
            margin-top: 1rem;
            padding: 1rem;
            border-radius: 4px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <header>
        <h1>SecureBank</h1>
        <p>Your Trusted Online Banking Partner</p>
    </header>
    
    <nav>
        <ul>
            <li><a href="Home-Login.php" id="home-link">Home</a></li>
            <li><a href="transfer page.php" id="transfer-link">Transfer</a></li>
            <li><a href="#" id="about-link">About</a></li>
            <li><a href="contact page.php" id="contact-link">Contact</a></li>
        </ul>
    </nav>
    
    <main>
        <!-- Login Form - Initially visible -->
        <div id="login-section" class="login-container">
            <h2>Login to Your Account</h2>
            <form id="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>
            </form>
            <p>Don't have an account? <a href="register.php" id="register-link">Register here</a></p>
            
            <!-- Login Response Section -->
            <div id="login-response">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    // Insecure login page - Vulnerable to SQL Injection
                    $conn = new mysqli("localhost", "root", "", "secure_bank_website_db");

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $username = $_POST['username'];
                        $password = $_POST['password'];

                        // Vulnerable SQL query - NEVER do this in production
                        $sql = "SELECT * FROM users WHERE username = '$username' AND password_hash = '$password'";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 1) {
                            echo "Login successful!";
                            
                            // Fetch the user data as an associative array
                            $user = $result->fetch_assoc();
                            
                            // Display user information
                            echo "<br>Welcome, " . $user['username'] . "!";
                            
                            // If you want to display all user data (not recommended for security reasons)
                            echo "<br>User details:<br>";
                            foreach ($user as $key => $value) {
                                echo $key . ": " . $value . "<br>";
                            }
                        } else {
                            echo "Invalid credentials.";
                        }
                        
                    }
                }
                ?>
                    
            </div>
        </div>
    </main>
    
    <footer>
        <p>&copy; 2025 SecureBank. All rights reserved.</p>
        <p><small>This is a demo website for educational purposes only.</small></p>
    </footer>

    <script>
        // Navigation functionality
        document.getElementById('home-link').addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = 'Home-Login.php';
        });
        
        document.getElementById('transfer-link').addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = 'transfer page.php';
        });
        
        document.getElementById('about-link').addEventListener('click', function(e) {
            e.preventDefault();
            alert('This is a demo banking website for CTF challenges.');
        });

        document.getElementById('contact-link').addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = 'contact page.php';
        });
        
        document.getElementById('register-link').addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = 'register.php';
        });
    </script>
</body>
</html>