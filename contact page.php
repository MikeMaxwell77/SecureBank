<?php
// Set a cookie (name, value, expiration time in seconds from now, path)
setcookie("SecretCookie", "[Flag]11110000$Flag$", time() + (3600), "/","",true,false); // 3600 = 1 hour

// Redirect to another page
header("Location: contact_page.php");
exit; // Important to include exit after redirect to prevent any code below from executing
?>