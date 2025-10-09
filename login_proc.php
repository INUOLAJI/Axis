<?php
// Start the session if it hasn't been started yet (though it should be in your main file)
// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }

require_once 'db_conn/conn.php';
// Assuming the Sanitize function is also available through the required file or globally.
global $conn;
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
    // 1. Sanitize and prepare input
    $email = Sanitize($_POST['email']);
    
    // Get the raw password input (DO NOT MD5 IT YET)
    $raw_password = $_POST['pword']; 

    // 2. Retrieve user data (including the stored password hash) based on the email
    // Use prepared statements for security. PostgreSQL identifiers are usually lowercase and unquoted.
    $sel_info = "SELECT uniqid, password FROM signup_biz WHERE email = :email";
    
    try {
        $stmt = $conn->prepare($sel_info);
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // 3. Check if a user was found and verify the password
        if ($row && password_verify($raw_password, $row['password'])) {
            
            // Password is correct! Set the session variable and redirect.
            $_SESSION['uid'] = $row['uniqid'];
             $msg ='success';
            $title = 'Login Successful';
            $text = "Welcome back!";
            // header('location:index.php');
         // Always exit after a header redirect
            
        } else {
            // No user found with that email, or password verification failed
            // echo "<script>
            // alert('Incorrect Password or Email');
            // window.location='index.php?showlogin=1';
            // </script>";
            $msg ='error';
            $title = 'Login Failed';
            $text = "Incorrect Password or Email";
                 
        }

    } catch (PDOException $e) {
        // Log the error (do NOT echo $e->getMessage() to the user in production)
        error_log("Login Database Error: " . $e->getMessage());
        echo "<script>
        alert('A system error occurred. Please try again later.');
        window.location='index.php?showlogin=1';
        </script>";
    }
}
?>

<!-- SweetAlert2 (latest version from jsDelivr CDN) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <script>
    Swal.fire({
        icon: '<?php echo $msg; ?>',
        title: '<?php echo $title; ?>',
        text: '<?php echo $text; ?>',
        confirmButtonText: 'Close'
    }).then(() => {
            window.location='index.php';// Redirect after alert is closed
       
    });
</script>
</body>

</html>