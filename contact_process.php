<?php
require 'vendor/autoload.php';
// contact_process.php - Secured with PHPMailer and Gmail SMTP

// !!! IMPORTANT: Get the PHPMailer files and correct the require paths !!!
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Assuming you've placed the files in a folder named 'vendor' or 'PHPMailer'
require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';


// --- CONFIGURATION ---
$recipient_email = "belloinuolaji@gmail.com"; 

// 🚨🚨 REPLACE THESE WITH YOUR ACTUAL GMAIL CREDENTIALS 🚨🚨
// 1. Your full sending Gmail address
$smtp_username = $recipient_email; 
// 2. The 16-character App Password you generated (NOT your main Gmail password)
$smtp_password = 'jwax vadt tfih oxip'; 
// ---------------------

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // --- 1. Collect and Sanitize Input ---
    function sanitize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $name    = sanitize_input($_POST['name']);
    $email   = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL); 
    $subject = sanitize_input($_POST['subject']);
    $message = sanitize_input($_POST['message']);

    if (!$email) {
        header('Location: index.html?status=error&msg=invalid_email');
        exit;
    }

    // --- 2. Construct Email Content ---
    $email_subject = "New Portfolio Message: " . $subject;
    $email_body = "You have received a new message from your contact form.\n\n";
    $email_body .= "Name: " . $name . "\n";
    $email_body .= "Email: " . $email . "\n";
    $email_body .= "Subject: " . $subject . "\n\n";
    $email_body .= "Message:\n" . $message . "\n";

    // --- 3. Use PHPMailer for Secure SMTP Sending ---
    $mail = new PHPMailer(true);

    try {
        // Server settings for Gmail
        $mail->isSMTP();                                        // Enable SMTP
        $mail->Host       = 'smtp.gmail.com';                 // Gmail SMTP server
        $mail->SMTPAuth   = true;                               // Enable authentication
        $mail->Username   = $smtp_username;                     // Gmail address
        $mail->Password   = $smtp_password;                     // Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;     // Use TLS encryption
        $mail->Port       = 587;                                // Port for TLS

        // Recipients
        // Sending FROM the authenticated Gmail account
        $mail->setFrom($smtp_username, 'Portfolio Contact Form'); 
        // Sending TO your recipient email
        $mail->addAddress($recipient_email, 'Recipient Name');    
        // Set the sender's email so you can hit Reply
        $mail->addReplyTo($email, $name); 

        // Content
        $mail->isHTML(false);                                   // Set to plain text
        $mail->Subject = $email_subject;
        $mail->Body    = $email_body;

        $mail->send();
        // Success: Redirect
        header('Location: index.html?status=success');

    } catch (Exception $e) {
        // Failure: Log the error and redirect
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        header('Location: index.html?status=error&msg=send_failed_smtp');
    }
    
} else {
    // If the page was accessed directly, redirect them back
    header('Location: index.html');
}

exit;
?>