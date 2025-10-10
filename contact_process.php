<?php
// Set your recipient email address here
$recipient_email = "YOUR_EMAIL@example.com"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // --- 1. Collect and Sanitize Input ---
    
    // Basic sanitization functions to prevent script injection (XSS)
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $name    = sanitize_input($_POST['name']);
    $email   = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL); // Validates and sanitizes email
    $subject = sanitize_input($_POST['subject']);
    $message = sanitize_input($_POST['message']);

    // Check if the email is valid
    if (!$email) {
        // Simple error handling: redirect back if email is invalid
        header('Location: index.html?status=error&msg=invalid_email');
        exit;
    }

    // --- 2. Construct Email Content ---
    
    $email_subject = "New Contact Form Message: " . $subject;
    
    $email_body = "You have received a new message from your portfolio contact form.\n\n";
    $email_body .= "Name: " . $name . "\n";
    $email_body .= "Email: " . $email . "\n";
    $email_body .= "Subject: " . $subject . "\n\n";
    $email_body .= "Message:\n" . $message . "\n";
    
    // --- 3. Set Headers ---
    
    // Required headers for proper email delivery and reply functionality
    $headers = "From: " . $name . " <" . $email . ">\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // --- 4. Send the Email ---
    
    if (mail($recipient_email, $email_subject, $email_body, $headers)) {
        // Success: Redirect the user to a thank you page or a success message
        header('Location: index.html?status=success');
    } else {
        // Failure: Mail function returned false (often a server configuration issue)
        header('Location: index.html?status=error&msg=send_failed');
    }
    
} else {
    // If the page was accessed directly, redirect them back
    header('Location: index.html');
}

exit;
?>