<?php
session_start();

/**
 * Load database credentials from environment variables (Render)
 * If not available, fallback to local dev values.
 */
$host = getenv('DB_HOST') ?: "aws-1-us-east-2.pooler.supabase.com";
$port = getenv('DB_PORT') ?: 6543;
$db_name = getenv('DB_NAME') ?: "postgres";
$user = getenv('DB_USER') ?: "postgres.aukqkugucnsfiflbtnwt";
$password = getenv('DB_PASSWORD') ?: "EOIrbndYzlGP4A7P";

try {
    // Construct the DSN with SSL mode enforced (required by Supabase)
    $dsn = "pgsql:host=$host;port=$port;dbname=$db_name;sslmode=require";

    // Create PDO connection
    $conn = new PDO(
        $dsn,
        $user,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );

} catch (PDOException $e) {
    // On Render, log errors instead of exposing them
    error_log("Database connection failed: " . $e->getMessage());

    // Show a user-friendly message
    die("<h3>⚠️ Unable to connect to database. Please try again later.</h3>");
}

/**
 * Sanitize user input to prevent XSS.
 */
function Sanitize($sanitize) {
    $sanitize = trim($sanitize);
    $sanitize = htmlspecialchars($sanitize, ENT_QUOTES, 'UTF-8');
    $sanitize = stripslashes($sanitize);
    return $sanitize;
}

/**
 * Get a user’s specific column value by unique_id.
 * Uses prepared statements for SQL safety.
 */
function u_info($uid, $info) {
    $cont = $GLOBALS['conn'];

    // Whitelist allowed columns to avoid SQL injection through $info
    $allowed = ['fname', 'lname', 'email', 'phone', 'biz_name', 'unique_id'];
    if (!in_array($info, $allowed)) {
        error_log("Invalid column name in u_info: " . $info);
        return null;
    }

    $sql = "SELECT \"$info\" FROM signup_biz WHERE unique_id = ?";
    try {
        $stmt = $cont->prepare($sql);
        $stmt->execute([$uid]);
        $row = $stmt->fetch();
        return $row ? $row[$info] : null;
    } catch (PDOException $e) {
        error_log("Error in u_info: " . $e->getMessage());
        return null;
    }
}
?>
