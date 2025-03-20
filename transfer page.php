<?php
// Start or resume the session
session_start();

// Check if user is logged in, redirect if not
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$db_host = "localhost";
$db_user = "db_username";
$db_pass = "db_password";
$db_name = "securebank";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID from session
$username = $_SESSION['username'];

// Fetch user's accounts - only the necessary fields
$stmt = $conn->prepare("SELECT account_number, balance FROM accounts WHERE username = ?");
$stmt->bind_param("i", $username);
$stmt->execute();
$result = $stmt->get_result();

// Store accounts in an array
$accounts = [];
while ($row = $result->fetch_assoc()) {
    $accounts[] = $row;
}

// Close connection
$stmt->close();
$conn->close();

// Format account number for display (show last 4 digits)
function formatAccountNumber($accountNumber) {
    return "XXXX-" . substr($accountNumber, -4);
}

// Format balance for display
function formatBalance($balance) {
    return "$" . number_format($balance, 2);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecureBank - Transfer Money</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }
        
        header {
            background-color: #004d99;
            color: white;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        
        .navigation {
            display: flex;
            gap: 15px;
        }
        
        .nav-btn {
            background-color: #003366;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        
        .transfer-container {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        
        .account-selector {
            margin-bottom: 20px;
        }
        
        .account-info {
            display: flex;
            justify-content: space-between;
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        
        .balance {
            font-weight: bold;
            color: #004d99;
        }
        
        h2 {
            margin-bottom: 15px;
            color: #004d99;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .transfer-options {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .transfer-option {
            flex: 1;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            text-align: center;
            cursor: pointer;
        }
        
        .transfer-option.selected {
            border-color: #004d99;
            background-color: #e6f0ff;
        }
        
        .submit-btn {
            background-color: #004d99;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 4px;
            width: 100%;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }
        
        .submit-btn:hover {
            background-color: #0066cc;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <div class="logo">SecureBank</div>
            <div class="navigation">
                <a href="logout.php" id="logout-link" class="nav-btn">Logout</a>
            </div>
        </div>
    </header>
    
    <main>
        <div class="transfer-container">
            <h2>Transfer Money</h2>
            
            <div class="account-selector">
                <label>From Account</label>
                <?php if(count($accounts) > 0): ?>
                <div class="account-info">
                    <span>Checking (<?php echo formatAccountNumber($accounts[0]['account_number']); ?>)</span>
                    <span class="balance">Balance: <?php echo formatBalance($accounts[0]['balance']); ?></span>
                </div>
                <?php else: ?>
                <div class="account-info">
                    <span>No accounts found</span>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="transfer-options">
                <div class="transfer-option selected" id="own-account">
                    <p>Between my accounts</p>
                </div>
                <div class="transfer-option" id="other-account">
                    <p>To someone else</p>
                </div>
            </div>
            
            <form id="transfer-form">
                <div class="form-group" id="own-account-select">
                    <label for="to-account">To Account</label>
                    <select id="to-account" name="to-account">
                        <?php 
                        for($i = 1; $i < count($accounts); $i++): 
                            $account = $accounts[$i];
                        ?>
                        <option value="<?php echo $i; ?>">
                            <?php echo ($i == 1 ? "Savings" : "Credit Card") . ' (' . formatAccountNumber($account['account_number']) . ') - ' . formatBalance($account['balance']); ?>
                        </option>
                        <?php endfor; ?>
                        
                        <?php if(count($accounts) <= 1): ?>
                        <option value="savings">Savings (XXXX-5678) - $0.00</option>
                        <?php endif; ?>
                    </select>
                </div>
                
                <div class="form-group" id="other-account-fields" style="display: none;">
                    <label for="recipient-name">Recipient Username</label>
                    <input type="text" id="recipient-name" name="recipient-name">
                    
                    <label for="recipient-account" style="margin-top: 10px;">Recipient Account Number</label>
                    <input type="text" id="recipient-account" name="recipient-account">
                    
                    <label for="recipient-bank" style="margin-top: 10px;">Recipient Bank</label>
                    <input type="text" id="recipient-bank" name="recipient-bank" value="SecureBank" disabled>
                </div>
                
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" id="amount" name="amount" step="0.01" min="0.01" placeholder="0.00">
                </div>
                
                <div class="form-group">
                    <label for="memo">Memo/Description (Optional)</label>
                    <input type="text" id="memo" name="memo" placeholder="e.g., Rent payment">
                </div>
                
                <button type="submit" class="submit-btn">Transfer Now</button>
            </form>
        </div>
    </main>

    <script>
        // Toggle between transfer types
        document.getElementById('own-account').addEventListener('click', function() {
            this.classList.add('selected');
            document.getElementById('other-account').classList.remove('selected');
            document.getElementById('own-account-select').style.display = 'block';
            document.getElementById('other-account-fields').style.display = 'none';
        });
        
        document.getElementById('other-account').addEventListener('click', function() {
            this.classList.add('selected');
            document.getElementById('own-account').classList.remove('selected');
            document.getElementById('own-account-select').style.display = 'none';
            document.getElementById('other-account-fields').style.display = 'block';
        });
        
        // Form submission handler (demo only, no actual transfer)
        document.getElementById('transfer-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form values
            const amount = document.getElementById('amount').value;
            const isOwnAccount = document.getElementById('own-account').classList.contains('selected');
            
            let recipient;
            if (isOwnAccount) {
                const toAccountSelect = document.getElementById('to-account');
                recipient = toAccountSelect.options[toAccountSelect.selectedIndex].text;
            } else {
                recipient = document.getElementById('recipient-name').value + 
                          ' (Acct: ' + document.getElementById('recipient-account').value + ')';
            }
            
            // Display confirmation (just a demo)
            alert(`Transfer of $${amount} to ${recipient} initiated successfully!`);
            
            // Log the transfer details (for demo purposes)
            console.log('Transfer details:', {
                amount: amount,
                recipient: recipient,
                memo: document.getElementById('memo').value,
                fromAccount: 'Checking (<?php echo isset($accounts[0]) ? formatAccountNumber($accounts[0]['account_number']) : "XXXX-1234"; ?>)'
            });
        });

        document.getElementById('logout-link').addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = 'logout.php';
        });
    </script>
</body>
</html>