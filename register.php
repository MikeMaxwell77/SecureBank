<?php
// Start session
session_start();

// Check for errors
$errors = isset($_SESSION['registration_errors']) ? $_SESSION['registration_errors'] : [];
$formData = isset($_SESSION['registration_data']) ? $_SESSION['registration_data'] : [
    'username' => ''
];

// Clear session variables
unset($_SESSION['registration_errors']);
unset($_SESSION['registration_data']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }
        
        body {
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .registration-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            padding: 30px;
        }
        
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }
        
        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        
        input:focus {
            outline: none;
            border-color: #4d90fe;
            box-shadow: 0 0 5px rgba(77, 144, 254, 0.5);
        }
        
        .btn {
            background-color: #4d90fe;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background-color: #357ae8;
        }
        
        .error {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
            display: none;
        }
        
        .errors-container {
            color: #e74c3c;
            background-color: #fde2e2;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        .errors-container ul {
            margin-left: 20px;
        }
        
        .password-requirements {
            background-color: #f9f9f9;
            border: 1px solid #eee;
            border-radius: 4px;
            padding: 10px;
            margin-top: 5px;
            font-size: 14px;
            color: #666;
        }
        
        .requirement {
            margin: 3px 0;
        }
        
        .valid {
            color: #27ae60;
        }
        
        .invalid {
            color: #e74c3c;
        }
        
        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }
        
        .login-link a {
            color: #4d90fe;
            text-decoration: none;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="registration-container">
        <h1>Create an Account</h1>
        
        <?php if (!empty($errors)): ?>
            <div class="errors-container">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form id="registration-form" action="register_process.php" method="post">
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($formData['username']); ?>" required>
                <div class="error" id="username-error">Username must be at least 5 characters</div>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <div class="password-requirements">
                    <p>Password must contain:</p>
                    <p class="requirement" id="length">• At least 8 characters</p>
                    <p class="requirement" id="uppercase">• At least one uppercase letter</p>
                    <p class="requirement" id="lowercase">• At least one lowercase letter</p>
                    <p class="requirement" id="number">• At least one number</p>
                    <p class="requirement" id="special">• At least one special character</p>
                </div>
            </div>
            
            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
                <div class="error" id="confirm-password-error">Passwords do not match</div>
            </div>
            
            <button type="submit" class="btn" id="register-btn">Register</button>
        </form>
        
        <div class="login-link">
            Already have an account? <a href="Home-Login.php" id="Home-Login">Log in</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registration-form');
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('confirm-password');
            const username = document.getElementById('username');
            
            // Password validation requirements
            const lengthReq = document.getElementById('length');
            const uppercaseReq = document.getElementById('uppercase');
            const lowercaseReq = document.getElementById('lowercase');
            const numberReq = document.getElementById('number');
            const specialReq = document.getElementById('special');
            
            // Validate password as user types
            password.addEventListener('input', function() {
                const value = password.value;
                
                // Check length
                if (value.length >= 8) {
                    lengthReq.classList.add('valid');
                    lengthReq.classList.remove('invalid');
                } else {
                    lengthReq.classList.add('invalid');
                    lengthReq.classList.remove('valid');
                }
                
                // Check uppercase
                if (/[A-Z]/.test(value)) {
                    uppercaseReq.classList.add('valid');
                    uppercaseReq.classList.remove('invalid');
                } else {
                    uppercaseReq.classList.add('invalid');
                    uppercaseReq.classList.remove('valid');
                }
                
                // Check lowercase
                if (/[a-z]/.test(value)) {
                    lowercaseReq.classList.add('valid');
                    lowercaseReq.classList.remove('invalid');
                } else {
                    lowercaseReq.classList.add('invalid');
                    lowercaseReq.classList.remove('valid');
                }
                
                // Check number
                if (/[0-9]/.test(value)) {
                    numberReq.classList.add('valid');
                    numberReq.classList.remove('invalid');
                } else {
                    numberReq.classList.add('invalid');
                    numberReq.classList.remove('valid');
                }
                
                // Check special character
                if (/[!@#$%^&*(),.?":{}|<>]/.test(value)) {
                    specialReq.classList.add('valid');
                    specialReq.classList.remove('invalid');
                } else {
                    specialReq.classList.add('invalid');
                    specialReq.classList.remove('valid');
                }
            });
            
            // Client-side form validation
            form.addEventListener('submit', function(e) {
                let isValid = true;
                
                // Validate username
                if (username.value.length < 5) {
                    document.getElementById('username-error').style.display = 'block';
                    isValid = false;
                } else {
                    document.getElementById('username-error').style.display = 'none';
                }
                
                // Validate password match
                if (password.value !== confirmPassword.value) {
                    document.getElementById('confirm-password-error').style.display = 'block';
                    isValid = false;
                } else {
                    document.getElementById('confirm-password-error').style.display = 'none';
                }
                
                // Check if all password requirements are met
                const passwordReqs = [lengthReq, uppercaseReq, lowercaseReq, numberReq, specialReq];
                const allReqsMet = passwordReqs.every(req => req.classList.contains('valid'));
                
                if (!allReqsMet) {
                    isValid = false;
                }
                
                if (!isValid) {
                    e.preventDefault();
                }
            });
        });
	document.getElementById('Home-Login').addEventListener('click', function(e) {
    		e.preventDefault();
    		// Your navigation logic here
    		// For example:
    		window.location.href = 'Home-Login.php';
    		// Or show an alert like your other links:
    		// alert('Navigating to new page...');
	});
        
    </script>
</body>
</html>