<?php
// login_proc.php

require_once 'db_conn/conn.php'; 
// Assumes conn.php defines: supabaseRequest(), Sanitize(), and session_start() is active.

// Initialize variables to prevent PHP errors before the POST request is processed
$msg = '';
$title = '';
$text = '';

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
    
    // 1. Sanitize input
    $email = Sanitize($_POST['email']);
    $raw_password = $_POST['pword']; // Raw password for secure verification

    // 2. Retrieve user data (hash and unique ID) via Supabase REST API
    // Filter by email and select the necessary columns.
    // The query part is: table_name?column_name=eq.value&select=columns
    $endpoint = "signup_biz?email=eq.$email&select=uniqid,password";
    $data = supabaseRequest($endpoint);
    
    // Check if the API returned data (meaning a user was found)
    if ($data && !empty($data[0])) {
        $user_row = $data[0];
        $stored_hash = $user_row['password'];

        // 3. Securely verify the password
        if (password_verify($raw_password, $stored_hash)) {
            
            // Password is correct!
            $_SESSION['uid'] = $user_row['uniqid'];
            $msg = 'success';
            $title = 'Login Successful';
            $text = "Welcome back!";
            
        } else {
            // Password verification failed
            $msg = 'error';
            $title = 'Login Failed';
            $text = "Incorrect Password or Email";
        }
    } else {
        // No user found with that email
        $msg = 'error';
        $title = 'Login Failed';
        $text = "Incorrect Password or Email";
    }

} else {
    // Handle cases where the form wasn't submitted correctly (optional)
    // You could redirect them or set a default error message.
    $msg = 'error';
    $title = 'Error';
    $text = "Form submission error.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Status</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
    Swal.fire({
        icon: '<?php echo $msg; ?>',
        title: '<?php echo $title; ?>',
        text: '<?php echo $text; ?>',
        confirmButtonText: 'OK'
    }).then(() => {
        // Redirect to the index page after the alert is closed
        window.location='index.php'; 
    });
    </script>
</body>
</html>