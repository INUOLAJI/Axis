<?php
session_start();

$host = getenv('DB_HOST') ?: 'aws-1-us-east-2.supabase.com';
$port = getenv('DB_PORT') ?: 5432;
$db_name = getenv('DB_NAME') ?: 'postgres';
$user = getenv('DB_USER') ?: 'postgres.aukqkugucnsfiflbtnwt';
$password = getenv('DB_PASSWORD') ?: 'EOIrbndYzlGP4A7P';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$db_name;sslmode=require";
    $conn = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // Test query
    $conn->query("SELECT 1");
} catch (PDOException $e) {
    echo "<h3>⚠️ Unable to connect to database. Please try again later.</h3>";
    echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
    exit;
}

function Sanitize($text) {
    $text = trim($text);
    $text = stripslashes($text);
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function u_info($uid, $info) {
    $cont = $GLOBALS['conn'];
    $get = "SELECT \"$info\" FROM signup_biz WHERE unique_id = ?";
    try {
        $stmt = $cont->prepare($get);
        $stmt->execute([$uid]);
        $row = $stmt->fetch();
        return $row[$info] ?? null;
    } catch (PDOException $e) {
        error_log("Error in u_info: " . $e->getMessage());
        return null;
    }
}
?>
