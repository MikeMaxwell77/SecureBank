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
                <input type="text" id="name" placeholder="Your full name">
            </div>
            
            <div class="form-group">
                <label for="topic">Topic</label>
                <select id="topic">
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
                <textarea id="message" rows="5" placeholder="How can we help you?"></textarea>
            </div>
            
            <button type="submit">Send Message</button>
        </form>
        
        <div id="messagePreview" class="message-preview">
            <h3>Message Preview</h3>
            <div id="previewContent"></div>
        </div>
    </div>

    <script>
        // Function to preview the message
        function previewMessage(event) {
            const name = document.getElementById('name').value;
            const message = document.getElementById('message').value;
            const topic = document.getElementById('topic').value;
            
            // Better to use textContent for security, but if you need HTML formatting:
            const previewDiv = document.getElementById('previewContent');
            previewDiv.innerHTML = '';  // Clear previous content
            
            // Create and append elements instead of using innerHTML for better security
            const fromP = document.createElement('p');
            fromP.innerHTML = '<strong>From:</strong> ' + name;
            
            const topicP = document.createElement('p');
            topicP.innerHTML = '<strong>Topic:</strong> ' + topic;
            
            const messageP = document.createElement('p');
            messageP.innerHTML = '<strong>Message:</strong> ' + message;
            
            previewDiv.appendChild(fromP);
            previewDiv.appendChild(topicP);
            previewDiv.appendChild(messageP);
            
            document.getElementById('messagePreview').style.display = 'block';
        }
    </script>
</body>
</html>