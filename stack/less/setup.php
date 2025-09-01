<?php
// NovaShop E-Commerce Setup Script
// Run this file once to set up your database and check system requirements

echo "<h1>NovaShop E-Commerce Setup</h1>";

// Check PHP version
echo "<h2>System Requirements Check</h2>";
$php_version = phpversion();
echo "<p><strong>PHP Version:</strong> $php_version</p>";

if (version_compare($php_version, '7.4.0', '>=')) {
    echo "<p>✅ PHP version is compatible</p>";
} else {
    echo "<p>❌ PHP version 7.4 or higher is required</p>";
}

// Check MySQL extension
if (extension_loaded('mysqli')) {
    echo "<p>✅ MySQLi extension is available</p>";
} else {
    echo "<p>❌ MySQLi extension is required</p>";
}

// Check session support
if (function_exists('session_start')) {
    echo "<p>✅ Session support is available</p>";
} else {
    echo "<p>❌ Session support is required</p>";
}

echo "<h2>Database Setup</h2>";

// Database configuration for cross-platform XAMPP
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'asifechom';
$port = 3306;

try {
    // Cross-platform database connection
    // For Windows XAMPP, use standard connection
    // For Linux XAMPP, socket path will be auto-detected
    $conn = new mysqli($host, $username, $password, '', $port);
    
    if ($conn->connect_error) {
        // Fallback for Linux XAMPP with socket
        if (file_exists('/opt/lampp/var/mysql/mysql.sock')) {
            $conn = new mysqli($host, $username, $password, '', $port, '/opt/lampp/var/mysql/mysql.sock');
        }
        
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }
    }
    
    echo "<p>✅ Connected to MySQL server</p>";
    
    // Check if database exists
    $result = $conn->query("SHOW DATABASES LIKE '$database'");
    
    if ($result->num_rows > 0) {
        echo "<p>✅ Database '$database' already exists</p>";
    } else {
        // Create database
        if ($conn->query("CREATE DATABASE $database")) {
            echo "<p>✅ Database '$database' created successfully</p>";
        } else {
            throw new Exception("Failed to create database: " . $conn->error);
        }
    }
    
    // Select database
    $conn->select_db($database);
    
    // Check if tables exist
    $tables = ['users', 'categories', 'products', 'orders', 'order_items', 'cart', 'wishlist', 'user_addresses'];
    $existing_tables = [];
    
    foreach ($tables as $table) {
        $result = $conn->query("SHOW TABLES LIKE '$table'");
        if ($result->num_rows > 0) {
            $existing_tables[] = $table;
        }
    }
    
    if (count($existing_tables) == count($tables)) {
        echo "<p>✅ All tables already exist</p>";
    } else {
        echo "<p>⚠️ Some tables are missing. Please import the database.sql file</p>";
        echo "<p>Missing tables: " . implode(', ', array_diff($tables, $existing_tables)) . "</p>";
    }
    
    // Test admin user
    $result = $conn->query("SELECT id FROM users WHERE email = 'admin@novashop.com'");
    if ($result->num_rows > 0) {
        echo "<p>✅ Admin user exists</p>";
    } else {
        echo "<p>⚠️ Admin user not found. Please import the database.sql file</p>";
    }
    
    $conn->close();
    
} catch (Exception $e) {
    echo "<p>❌ Database Error: " . $e->getMessage() . "</p>";
}

echo "<h2>File Permissions Check</h2>";

$directories = ['config', 'src/helpers', 'public/css'];
foreach ($directories as $dir) {
    if (is_dir($dir)) {
        echo "<p>✅ Directory '$dir' exists</p>";
    } else {
        echo "<p>❌ Directory '$dir' is missing</p>";
    }
}

$files = ['./config/database.php', 'src/helpers/session.php', 'src/helpers/header.php', 'src/helpers/footer.php', 'public/css/style.css'];
foreach ($files as $file) {
    if (file_exists($file)) {
        echo "<p>✅ File '$file' exists</p>";
    } else {
        echo "<p>❌ File '$file' is missing</p>";
    }
}

echo "<h2>Setup Instructions</h2>";
echo "<ol>";
echo "<li>Make sure all system requirements are met (✅ above)</li>";
echo "<li>If database tables are missing, import the database.sql file in phpMyAdmin</li>";
echo "<li>Configure database connection in config/database.php if needed</li>";
echo "<li>Start your web server and navigate to the project directory</li>";
echo "<li>Login with admin@novashop.com / password</li>";
echo "</ol>";

echo "<h2>Next Steps</h2>";
echo "<p><a href='index.php'>Go to Homepage</a></p>";
echo "<p><a href='login.php'>Go to Login</a></p>";
echo "<p><a href='register.php'>Go to Registration</a></p>";

echo "<p><strong>Note:</strong> Delete this setup.php file after successful setup for security.</p>";
?>
