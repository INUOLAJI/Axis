<?php
// signup_proc.php

require_once 'db_conn/conn.php'; 
// Assumes conn.php defines: supabaseRequest(), Sanitize(), and session_start() is active.

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
    
    // 1. Sanitize and prepare input
    $fname = Sanitize($_POST['fname']);
    $email = Sanitize($_POST['email']);
    
    // IMPORTANT: Use password_hash() for security instead of md5()
    $raw_pword = $_POST['pword'];
    $raw_cword = $_POST['cword'];
    $pword_hash = password_hash($raw_pword, PASSWORD_DEFAULT);
    
    $uid = uniqid();

    // 2. Password Match Check
    if ($raw_pword !== $raw_cword) {
        echo "<script>
        alert('Password doesn\\'t match Confirm Password');
        window.location='index.php?showsignup=1';
        </script>";
        exit;
    }

    // 3. Check for existing user (fname OR email) via API
    // The filter checks for rows where fname matches OR email matches.
    $check_endpoint = "signup_biz?or=(fname.eq.$fname,email.eq.$email)&select=fname,email";
    $existing_data = supabaseRequest($check_endpoint, 'GET');

    // Handle potential API failure
    if ($existing_data === null) {
        error_log("Supabase check request failed during signup.");
        echo "<script>
        alert('A critical system error occurred while checking user data. Please try again.');
        window.location='index.php';
        </script>";
        exit;
    }

    // Check if any existing user records were found
    if (!empty($existing_data)) {
        
        $existing_user = $existing_data[0];
        $alert_message = '';
        
        // Determine the specific conflict for the alert
        if (isset($existing_user['fname']) && $existing_user['fname'] === $fname) {
            $alert_message = "User with name '{$fname}' already exists.";
        } else if (isset($existing_user['email']) && $existing_user['email'] === $email) {
            $alert_message = "User with email '{$email}' already exists.";
        } else {
             // Fallback if the specific conflict can't be determined
            $alert_message = "A user account already exists with one of the provided details.";
        }

        echo "<script>
        alert('{$alert_message}');
        window.location='index.php';
        </script>";
        exit;

    } else {
        // 4. Insert New User via Supabase REST API (POST request)
        $new_user_data = [
            'uniqid' => $uid,
            'fname' => $fname,
            'email' => $email,
            'password' => $pword_hash // Stored using password_hash()
        ];

        // The endpoint is just the table name, the method is POST
        $insert_endpoint = "signup_biz";
        $response = supabaseRequest($insert_endpoint, 'POST', $new_user_data);
        
        // Check if the insertion was successful
        // Supabase returns an array of the inserted row(s) on success, or null on failure.
        if ($response && !empty($response[0]) && isset($response[0]['id'])) {
            echo "<script>
            alert('Account Created Successfully! Go back to the login page to sign in');
            window.location='index.php?showlogin=1';
            </script>";
            exit;
        } else {
            // API insertion failed or returned unexpected data
            error_log("Supabase insert failed. Response: " . print_r($response, true));
            echo "<script>
            alert('An error occurred during account creation.');
            window.location='index.php';
            </script>";
            exit;
        }
    }
}
?>