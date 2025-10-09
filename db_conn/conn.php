<?php
session_start();

// $host = getenv('DB_HOST');
// $port = getenv('DB_PORT');
// $db_name = getenv('DB_NAME');
// $user = getenv('DB_USER');
// $password = getenv('DB_PASSWORD'); 

// Database Connection Details for Supabase (PostgreSQL)
// NOTE: I'm using the connection details you provided.
$host = "aws-1-us-east-2.pooler.supabase.com";
$port = 6543;
$db_name = "postgres";
$user = "postgres.aukqkugucnsfiflbtnwt";
$password = "EOIrbndYzlGP4A7P"; 

try {
    // Establish PDO connection
    $conn = new PDO(
        "pgsql:host=$host;port=$port;dbname=$db_name; sslmode=require",
        $user,
        $password,
        [
            // Throw exceptions on error for better debugging
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // Set default fetch mode to associative array
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    // Display error message and halt script execution
    // In a production environment, you should log the error and display a generic message.
    die("Connection failed: " . $e->getMessage());
    // exit() is redundant after die() but harmless
}


/**
 * Function to sanitize user input.
 * This is primarily for displaying data safely (HTML escaping).
 * Prepared statements (used in u_info) handle SQL injection protection.
 */
function Sanitize($santize){
    $santize = trim($santize);
    // htmlspecialchars() converts special characters to HTML entities, preventing XSS
    $santize = htmlspecialchars($santize);
    // stripslashes() removes backslashes
    $santize = stripslashes($santize);

    return $santize;
}


/**
 * Secure function to retrieve a specific column value for a user ID
 * converted to use PDO Prepared Statements for PostgreSQL.
 * * @param string $uid The unique ID of the user.
 * @param string $info The name of the column/info to retrieve (e.g., 'fname', 'email').
 * @return string The value of the requested info, or null if not found.
 */
function u_info($uid, $info){
    // Access the global PDO connection object
    $cont = $GLOBALS['conn'];
    
    // IMPORTANT: Use prepared statement with a placeholder (?) and double quotes for column name
    // We dynamically include $info in the query string, which is generally safe
    // for column names but requires careful validation if $info comes from user input.
    $get = "SELECT \"$info\" FROM signup_biz WHERE unique_id = ?";
    
    try {
        $stmt = $cont->prepare($get);
        
        // Execute the statement with the unique ID as the parameter
        $stmt->execute([$uid]);
        
        // Fetch the row as an associative array
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Check if a row was found and return the requested column value
        return $row ? $row[$info] : null;

    } catch (PDOException $e) {
        // Handle potential SQL errors during query execution
        error_log("Error in u_info: " . $e->getMessage());
        return null; 
    }
}

// The original MySQLi connection check is no longer needed/relevant for PDO success
// but the try...catch block already handles connection failure.
?>