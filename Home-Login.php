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
            <form id="login-form">
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
            <p>Don't have an account? <a href="#" id="register-link">Register here</a></p>
        </div>
        
        <!-- Account Overview - Initially hidden -->
        <div id="account-section" class="hidden">
            <h2>Welcome, <span id="user-name">User</span>!</h2>
            
            <div class="account-overview">
                <h3>Your Accounts</h3>
                
                <div class="account-card">
                    <h4>Checking Account</h4>
                    <p>Account Number: XXXX-XXXX-1234</p>
                    <p>Balance: $<span id="checking-balance">2,543.87</span></p>
                </div>
                
                <div class="account-card">
                    <h4>Savings Account</h4>
                    <p>Account Number: XXXX-XXXX-5678</p>
                    <p>Balance: $<span id="savings-balance">15,789.32</span></p>
                </div>
                
                <h3>Recent Transactions</h3>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr style="background-color: #f2f2f2;">
                        <th style="text-align: left; padding: 8px;">Date</th>
                        <th style="text-align: left; padding: 8px;">Description</th>
                        <th style="text-align: right; padding: 8px;">Amount</th>
                    </tr>
                    <tr>
                        <td style="padding: 8px;">2025-03-07</td>
                        <td style="padding: 8px;">Grocery Store</td>
                        <td style="padding: 8px; text-align: right;">-$78.45</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px;">2025-03-05</td>
                        <td style="padding: 8px;">Salary Deposit</td>
                        <td style="padding: 8px; text-align: right;">+$2,450.00</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px;">2025-03-02</td>
                        <td style="padding: 8px;">Electric Bill</td>
                        <td style="padding: 8px; text-align: right;">-$145.30</td>
                    </tr>
                </table>
            </div>
        </div>
    </main>
    
    <footer>
        <p>&copy; 2025 SecureBank. All rights reserved.</p>
        <p><small>This is a demo website for educational purposes only.</small></p>
    </footer>

    <script>
        // Simple functionality for demonstration purposes
        document.getElementById('login-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            
            // Simulate authentication - This will be where vulnerabilities can be added
            if (username && password) {
                document.getElementById('login-section').classList.add('hidden');
                document.getElementById('account-section').classList.remove('hidden');
                document.getElementById('user-name').textContent = username;
            }
        });
        
        // Navigation functionality
        document.getElementById('home-link').addEventListener('click', function(e) {
    		e.preventDefault();
    		// Your navigation logic here
    		// For example:
    		window.location.href = 'Home-Login.php';
    		// Or show an alert like your other links:
    		// alert('Navigating to new page...');
	});
	document.getElementById('transfer-link').addEventListener('click', function(e) {
    		e.preventDefault();
    		// Your navigation logic here
    		// For example:
    		window.location.href = 'transfer page.php';
    		// Or show an alert like your other links:
    		// alert('Navigating to new page...');
	});
        
        
        document.getElementById('about-link').addEventListener('click', function(e) {
            e.preventDefault();
            alert('This is a demo banking website for CTF challenges.');
        });

	document.getElementById('contact-link').addEventListener('click', function(e) {
    		e.preventDefault();
    		// Your navigation logic here
    		// For example:
    		window.location.href = 'contact page.php';
    		// Or show an alert like your other links:
    		// alert('Navigating to new page...');
	});
        
        document.getElementById('register-link').addEventListener('click', function(e) {
    		e.preventDefault();
    		// Your navigation logic here
    		// For example:
    		window.location.href = 'register.php';
    		// Or show an alert like your other links:
    		// alert('Navigating to new page...');
	});
        
    </script>
</body>
</html>