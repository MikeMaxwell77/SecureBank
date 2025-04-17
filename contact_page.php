<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['xss_triggered']) && $_GET['xss_triggered'] === 'true') {
    setcookie("SecretCookie", "Myflag11110000flag", time() + 3600, "/", "", false, false);
    echo "Cookie set!";
    exit; // Stop further output
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Secure Remote Bank</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }
        header {
            background-color: #004d99;
            color: white;
            padding: 1rem;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        input, select, textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: inherit;
        }
        button {
            background-color: #004d99;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            margin-right: 10px;
        }
        button:hover {
            background-color: #003366;
        }
        .message-preview {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
            display: none;
        }
    </style>
</head>
<body>
    <header>
        <h1>Secure Remote Bank</h1>
    </header>
    
    <div class="container">
        <h2>Contact Us</h2>
        <p>Please complete the form below and we'll get back to you as soon as possible.</p>
        
        <form id="contactForm" onsubmit="previewMessage(event)">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Your full name" required>
            </div>
            
            <div class="form-group">
                <label for="topic">Topic</label>
                <select id="topic" name="topic" required>
                    <option value="">Select a topic</option>
                    <option value="account">Account Questions</option>
                    <option value="online">Online Banking</option>
                    <option value="mobile">Mobile Banking</option>
                    <option value="card">Debit/Credit Card</option>
                    <option value="loan">Loans</option>
                    <option value="security">Security Concerns</option>
                    <option value="other">Other</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="5" placeholder="How can we help you?" required></textarea>
            </div>
            
            <button type="submit">Preview</button>
            <button type="button" id="sendButton">Send Message</button>
        </form>
        
        <div id="messagePreview" class="message-preview">
            <h3>Message Preview</h3>
            <div id="previewContent"></div>
        </div>
    </div>

    <script>
        let triggered = false;

        window.onerror = function(message, source, lineno, colno, error) {
            if (!triggered) {
                triggered = true;
                fetch(window.location.pathname + '?xss_triggered=true');
            }
            return true;
        };

        function previewMessage(event) {
            event.preventDefault();
            
            const name = document.getElementById('name').value;
            const message = document.getElementById('message').value;
            const topic = document.getElementById('topic').value;
            
            const previewDiv = document.getElementById('previewContent');
            previewDiv.innerHTML = `
                <p><strong>From:</strong> ${name}</p>
                <p><strong>Topic:</strong> ${topic}</p>
                <p><strong>Message:</strong> ${message}</p>
            `;
            
            document.getElementById('messagePreview').style.display = 'block';
        }
    </script>
</body>
</html>