<?php
// 1. Database Connection Details (REPLACE WITH YOUR ACTUAL CREDENTIALS)
// NOTE: I'm using the connection details you provided earlier.
$host = "aws-1-us-east-2.pooler.supabase.com";
$port = 6543;
$db_name = "postgres";
$user = "postgres.aukqkugucnsfiflbtnwt";
$password = "EOIrbndYzlGP4A7P"; 

$dsn = "pgsql:host=$host;port=$port;dbname=$db_name; sslmode=require";

// 2. Connection Test Logic
try {
    // Attempt to establish PDO connection
    $conn = new PDO(
        $dsn,
        $user,
        $password,
        [
            // Throw exceptions on error
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

    // If the PDO object is successfully created without throwing an exception:
    echo "<h1>✅ Database Connection Successful!</h1>";
    echo "<p>Connected to PostgreSQL (Supabase) at host: **$host**</p>";

    // Optional: Run a simple query to ensure the connection is active and can query data
    // This queries the current server time and version
    $stmt = $conn->query("SELECT version(), NOW()");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo "<h2>Server Details:</h2>";
    echo "<p>PostgreSQL Version: **" . htmlspecialchars($result['version']) . "**</p>";
    echo "<p>Current Server Time: **" . htmlspecialchars($result['now']) . "**</p>";

} catch (PDOException $e) {
    // If the connection fails, catch the exception and display the error
    echo "<h1>❌ Database Connection Failed!</h1>";
    echo "<p>Error: **" . htmlspecialchars($e->getMessage()) . "**</p>";
    echo "<p>Please double-check your host, port, database name, username, and password.</p>";
}

// Ensure the connection is closed
$conn = null;
?>