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
                <label for="email">Email Address</label>
                <input type="email" id="email" placeholder="Your email address">
            </div>
            
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" placeholder="Your phone number">
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
        // Handle form submission
        function previewMessage(event) {
            event.preventDefault();
            
            const name = document.getElementById('name').value;
            const message = document.getElementById('message').value;
            const topic = document.getElementById('topic').value;
            
            // XSS vulnerability: Directly inserting user input into the DOM without sanitization
            const previewDiv = document.getElementById('previewContent');
            previewDiv.innerHTML = `
                <p><strong>From:</strong> ${name}</p>
                <p><strong>Topic:</strong> ${topic}</p>
                <p><strong>Message:</strong> ${message}</p>
            `;
            
            document.getElementById('messagePreview').style.display = 'block';
        }
        
        // Obfuscated flag and validator
        (function() {
            const _0x5a46=['Q1RGe3hzc19leHBsb2l0X3N1Y2Nlc3NfMjAyNH0=','createElement','style','display:none','appendChild','body','setAttribute','data-flag','log'];
            const _0x37e6=function(_0x5a46db,_0x37e6a3){_0x5a46db=_0x5a46db-0x0;let _0x64e8a9=_0x5a46[_0x5a46db];return _0x64e8a9;};
            const flagData=atob(_0x37e6('0x0'));
            const hiddenElem=document[_0x37e6('0x1')](_0x37e6('0x2'));
            hiddenElem[_0x37e6('0x2')][_0x37e6('0x3')]=_0x37e6('0x3');
            document[_0x37e6('0x4')][_0x37e6('0x5')](hiddenElem);
            hiddenElem[_0x37e6('0x6')](_0x37e6('0x7'),flagData);
            
            // Define the secret function with a non-obvious name
            window['___sys_check_validation'] = function() {
                const flagElem = document.querySelector('[data-flag]');
                if(flagElem) {
                    const flagValue = flagElem.getAttribute('data-flag');
                    const alertDiv = document.createElement('div');
                    alertDiv.style = 'position:fixed;top:0;left:0;right:0;background:#ffcc00;color:#000;padding:15px;text-align:center;font-weight:bold;z-index:9999;';
                    alertDiv.textContent = 'Congratulations! ' + flagValue;
                    document.body.appendChild(alertDiv);
                }
            };
            
            // Hidden property to track if alert has been shown
            Object.defineProperty(window, '_xss_triggered', {
                value: false,
                writable: true,
                enumerable: false,
                configurable: false
            });
            
            // Automatically check for suspicious event handlers
            setTimeout(function() {
                const detectXSS = function() {
                    if(window._xss_triggered) return;
                    const scripts = document.querySelectorAll('script:not([src])');
                    const suspiciousAttrs = ['onerror', 'onload', 'onclick', 'onmouseover'];
                    const elements = document.querySelectorAll('*');
                    
                    for(const elem of elements) {
                        for(const attr of suspiciousAttrs) {
                            if(elem.hasAttribute(attr)) {
                                window._xss_triggered = true;
                                window.___sys_check_validation();
                                return;
                            }
                        }
                    }
                    
                    if(scripts.length > 1) {
                        window._xss_triggered = true;
                        window.___sys_check_validation();
                    }
                };
                
                // Check periodically
                setInterval(detectXSS, 1000);
            }, 2000);
        })();
    </script>
</body>
</html>