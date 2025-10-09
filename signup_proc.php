<?php
require_once 'db_conn/conn.php'; // Now contains the PDO connection $conn
// Note: You must ensure 'Sanitize' function is also available, either in conn.php or here.

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
        window.location='navbar.php?showsignup=1';
        </script>";
        exit;
    }

    // 3. Check for existing user (fname or email)
    // Using a single, efficient query with prepared statements
    $check_sql = "SELECT id FROM signup_biz WHERE fname = :fname OR email = :email";
    
    try {
        $stmt = $conn->prepare($check_sql);
        $stmt->execute(['fname' => $fname, 'email' => $email]);
        $user_count = $stmt->rowCount();

        if ($user_count > 0) {
            // Fetch one row to determine which field caused the conflict
            $existing_user = $stmt->fetch();

            $alert_message = '';
            if ($existing_user['fname'] === $fname) {
                $alert_message = "User with '{$fname}' already exists.";
            } else if ($existing_user['email'] === $email) {
                $alert_message = "User with '{$email}' already exists.";
            }

            echo "<script>
            alert('{$alert_message}');
            window.location='navbar.php';
            </script>";
            exit;

        } else {
            // 4. Insert New User
            $insert_sql = "INSERT INTO signup_biz (uniqid, fname, email, password) 
                           VALUES (:uid, :fname, :email, :password_hash)";
            
            $stmt = $conn->prepare($insert_sql);
            
            if ($stmt->execute([
                'uid' => $uid,
                'fname' => $fname,
                'email' => $email,
                'password_hash' => $pword_hash
            ])) {
                echo "<script>
                alert('Account Created Successfully! Go back to the login page to sign in');
                window.location='navbar.php?showlogin=1';
                </script>";
                exit;
            } else {
                // This block is often caught by the PDOException, but good to have
                echo "<script>
                alert('An error occurred during account creation.');
                window.location='navbar.php';
                </script>";
                exit;
            }
        }

    } catch (PDOException $e) {
        // Log the error (do NOT echo $e->getMessage() to the user)
        error_log("Database Error: " . $e->getMessage());
        echo "<script>
        alert('A critical database error occurred. Please try again later.');
        window.location='navbar.php';
        </script>";
        exit;
    }
}
?>