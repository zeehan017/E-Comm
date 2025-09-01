<?php
// Cross-Platform Setup Script for NovaShop E-Commerce
// Works on Windows, Mac, and Linux

// Include system configuration
require_once 'config/system_config.php';

echo "<h1>NovaShop E-Commerce - Cross-Platform Setup</h1>";

// System Information
$os = get_operating_system();
$paths = get_system_paths();

echo "<h2>System Information</h2>";
echo "<p><strong>Operating System:</strong> $os</p>";
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
echo "<p><strong>Server Software:</strong> " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown') . "</p>";

// System Requirements Check
echo "<h2>System Requirements Check</h2>";

// PHP Version
$php_version = phpversion();
if (version_compare($php_version, '7.4.0', '>=')) {
    echo "<p>✅ PHP version is compatible ($php_version)</p>";
} else {
    echo "<p>❌ PHP version 7.4 or higher is required (Current: $php_version)</p>";
}

// MySQL Extension
if (extension_loaded('mysqli')) {
    echo "<p>✅ MySQLi extension is available</p>";
} else {
    echo "<p>❌ MySQLi extension is required</p>";
}

// Session Support
if (function_exists('session_start')) {
    echo "<p>✅ Session support is available</p>";
} else {
    echo "<p>❌ Session support is required</p>";
}

// XAMPP Installation Check
echo "<h2>XAMPP Installation Check</h2>";
if (is_dir($paths['xampp_path'])) {
    echo "<p>✅ XAMPP found at: " . $paths['xampp_path'] . "</p>";
} else {
    echo "<p>❌ XAMPP not found at: " . $paths['xampp_path'] . "</p>";
    echo "<p><strong>Installation Instructions:</strong></p>";
    switch ($os) {
        case 'WINDOWS':
            echo "<p>Download XAMPP for Windows from <a href='https://www.apachefriends.org/' target='_blank'>apachefriends.org</a></p>";
            break;
        case 'MAC':
            echo "<p>Download XAMPP for macOS from <a href='https://www.apachefriends.org/' target='_blank'>apachefriends.org</a></p>";
            break;
        case 'LINUX':
            echo "<p>Download XAMPP for Linux from <a href='https://www.apachefriends.org/' target='_blank'>apachefriends.org</a></p>";
            break;
    }
}

// Database Setup
echo "<h2>Database Setup</h2>";

try {
    // Test database connection
    $conn = get_system_db_connection('localhost', 'root', '', '');
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    echo "<p>✅ Connected to MySQL server</p>";
    
    // Check if database exists
    $result = $conn->query("SHOW DATABASES LIKE 'asifechom'");
    
    if ($result->num_rows > 0) {
        echo "<p>✅ Database 'asifechom' already exists</p>";
    } else {
        // Create database
        if ($conn->query("CREATE DATABASE asifechom")) {
            echo "<p>✅ Database 'asifechom' created successfully</p>";
        } else {
            throw new Exception("Failed to create database: " . $conn->error);
        }
    }
    
    // Select database
    $conn->select_db('asifechom');
    
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
    echo "<p><strong>Troubleshooting:</strong></p>";
    echo "<ul>";
    echo "<li>Make sure XAMPP is running</li>";
    echo "<li>Start Apache and MySQL services</li>";
    echo "<li>Check if MySQL is running on port 3306</li>";
    echo "<li>Verify database credentials</li>";
    echo "</ul>";
}

// File Permissions Check
echo "<h2>File Permissions Check</h2>";

$directories = ['config', 'src/helpers', 'public/css'];
foreach ($directories as $dir) {
    if (is_dir($dir)) {
        echo "<p>✅ Directory '$dir' exists</p>";
        if (is_readable($dir)) {
            echo "<p>✅ Directory '$dir' is readable</p>";
        } else {
            echo "<p>❌ Directory '$dir' is not readable</p>";
        }
    } else {
        echo "<p>❌ Directory '$dir' is missing</p>";
    }
}

$files = ['config/database.php', 'src/helpers/session.php', 'src/helpers/header.php', 'src/helpers/footer.php', 'public/css/style.css'];
foreach ($files as $file) {
    if (file_exists($file)) {
        echo "<p>✅ File '$file' exists</p>";
        if (is_readable($file)) {
            echo "<p>✅ File '$file' is readable</p>";
        } else {
            echo "<p>❌ File '$file' is not readable</p>";
        }
    } else {
        echo "<p>❌ File '$file' is missing</p>";
    }
}

// System-Specific Instructions
echo "<h2>System-Specific Setup Instructions</h2>";

switch ($os) {
    case 'WINDOWS':
        echo "<h3>Windows Setup</h3>";
        echo "<ol>";
        echo "<li>Start XAMPP Control Panel</li>";
        echo "<li>Start Apache and MySQL services</li>";
        echo "<li>Import database.sql in phpMyAdmin</li>";
        echo "<li>Navigate to http://localhost/E-Comm/</li>";
        echo "</ol>";
        break;
        
    case 'MAC':
        echo "<h3>macOS Setup</h3>";
        echo "<ol>";
        echo "<li>Start XAMPP from Applications</li>";
        echo "<li>Start Apache and MySQL services</li>";
        echo "<li>Import database.sql in phpMyAdmin</li>";
        echo "<li>Navigate to http://localhost/E-Comm/</li>";
        echo "</ol>";
        break;
        
    case 'LINUX':
        echo "<h3>Linux Setup</h3>";
        echo "<ol>";
        echo "<li>Start XAMPP: sudo /opt/lampp/lampp start</li>";
        echo "<li>Import database.sql in phpMyAdmin</li>";
        echo "<li>Navigate to http://localhost/E-Comm/</li>";
        echo "</ol>";
        break;
}

// Test Links
echo "<h2>Test Your Installation</h2>";
echo "<p><a href='index.php'>Go to Homepage</a></p>";
echo "<p><a href='login.php'>Go to Login</a></p>";
echo "<p><a href='register.php'>Go to Registration</a></p>";

echo "<p><strong>Default Admin Login:</strong></p>";
echo "<ul>";
echo "<li>Email: admin@novashop.com</li>";
echo "<li>Password: password</li>";
echo "</ul>";

echo "<p><strong>Note:</strong> Delete this setup file after successful installation for security.</p>";
?>
