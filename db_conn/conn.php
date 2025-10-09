<?php
session_start();

/**
 * ===============================
 *  SUPABASE CONNECTION SETTINGS
 * ===============================
 * Replace the placeholders below with your actual Supabase credentials.
 * Get them from: Project → Settings → API
 */
define('SUPABASE_URL', 'https://aukqkugucnsfiflbtnwt.supabase.co'); // e.g. https://abcd1234.supabase.co
define('SUPABASE_KEY', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImF1a3FrdWd1Y25zZmlmbGJ0bnd0Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NjAwMTc3NzIsImV4cCI6MjA3NTU5Mzc3Mn0.oHg1Zx3I3JBmlx1XjXU-cXFcw6pvf8y9My2Sz4bUUkk'); // e.g. eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...


/**
 * ==========================================
 *  Reusable Function: Call Supabase REST API
 * ==========================================
 */
function supabaseRequest($endpoint, $method = 'GET', $body = null) {
    $url = SUPABASE_URL . '/rest/v1/' . ltrim($endpoint, '/');

    $headers = [
        'apikey: ' . SUPABASE_KEY,
        'Authorization: Bearer ' . SUPABASE_KEY,
        'Content-Type: application/json',
        'Prefer: return=representation'
    ];

    $options = [
        'http' => [
            'method' => $method,
            'header' => implode("\r\n", $headers),
            'content' => $body ? json_encode($body) : null
        ]
    ];

    $context = stream_context_create($options);
    $response = @file_get_contents($url, false, $context);

    if ($response === false) {
        error_log("Supabase API request failed for endpoint: $endpoint");
        return null;
    }

    return json_decode($response, true);
}


/**
 * ============================
 *  Input Sanitization Helper
 * ============================
 */
function Sanitize($value) {
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    return $value;
}


/**
 * ====================================================
 *  Function: Get User Info by Unique ID (u_info)
 * ====================================================
 * Reads from the 'signup_biz' table in Supabase
 */
function u_info($uid, $column) {
    $data = supabaseRequest("signup_biz?uniqid=eq.$uid&select=$column");
    return $data && isset($data[0][$column]) ? $data[0][$column] : null;
}

?>
