<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'asifechom');

// Application configuration
define('APP_NAME', 'NovaShop');
define('APP_URL', 'http://localhost/E-Comm/public');
define('APP_VERSION', '1.0.0');

// Create connection
try {
    // For XAMPP, specify the socket path
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, 3306, '/opt/lampp/var/mysql/mysql.sock');
    
    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    // Set charset to utf8
    $conn->set_charset("utf8");
    
} catch (Exception $e) {
    die("Database connection error: " . $e->getMessage());
}

// Helper function to escape strings
function escape_string($string) {
    global $conn;
    return mysqli_real_escape_string($conn, $string);
}

// Helper function to execute queries
function execute_query($sql) {
    global $conn;
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        throw new Exception("Query failed: " . mysqli_error($conn));
    }
    return $result;
}

// Helper function to get single row
function get_single_row($sql) {
    $result = execute_query($sql);
    return mysqli_fetch_assoc($result);
}

// Helper function to get multiple rows
function get_multiple_rows($sql) {
    $result = execute_query($sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Helper function to get row count
function get_row_count($sql) {
    $result = execute_query($sql);
    return mysqli_num_rows($result);
}

// Helper function to get last insert ID
function get_last_insert_id() {
    global $conn;
    return mysqli_insert_id($conn);
}
?>
