<?php
// contact_process.php - Secured with PHPMailer and Gmail SMTP

// --- 1. INCLUDE PHPMailer FILES ---
// Removed 'require 'vendor/autoload.php';' as it conflicts with manual requires.
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// 🚨🚨 CRITICAL: Use the actual relative paths to your files 🚨🚨
// This assumes the files are in a folder named 'PHPMailer' right next to this script.
require 'PHPMailer/Exception.php'; 
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


// --- 2. CONFIGURATION ---
$recipient_email = "belloinuolaji@gmail.com"; 

// The App Password must be 16 characters and should NOT have spaces in the code!
// While Google displays it with spaces, you must enter it without spaces in the code.
$smtp_username = $recipient_email; 
$smtp_password = 'jwaxvadttfihoxip'; // App Password with spaces removed
// ---------------------

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // --- 3. Collect and Sanitize Input (Same as before) ---
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

    // --- 4. Construct Email Content (Same as before) ---
    $email_subject = "New Portfolio Message: " . $subject;
    $email_body = "You have received a new message from your contact form.\n\n";
    $email_body .= "Name: " . $name . "\n";
    $email_body .= "Email: " . $email . "\n";
    $email_body .= "Subject: " . $subject . "\n\n";
    $email_body .= "Message:\n" . $message . "\n";

    // --- 5. Use PHPMailer for Secure SMTP Sending ---
    $mail = new PHPMailer(true);

    try {
        // Server settings for Gmail
        $mail->isSMTP();                                        
        $mail->Host       = 'smtp.gmail.com';                 
        $mail->SMTPDebug  = 0; // Set to 2 for detailed error output when testing
        $mail->SMTPAuth   = true;                              
        $mail->Username   = $smtp_username;                    
        $mail->Password   = $smtp_password;                    
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;    
        $mail->Port       = 587;                               

        // Recipients
        $mail->setFrom($smtp_username, 'Portfolio Contact Form'); 
        $mail->addAddress($recipient_email, 'Recipient Name');    
        $mail->addReplyTo($email, $name);                      

        // Content
        $mail->isHTML(false);                                   
        $mail->Subject = $email_subject;
        $mail->Body    = $email_body;

        $mail->send();
        header('Location: index.html?status=success');

    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        header('Location: index.html?status=error&msg=send_failed_smtp');
    }
    
} else {
    header('Location: index.html');
}

exit;
?>