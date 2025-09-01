<?php
// Windows Setup Script for NovaShop E-Commerce
// Run this file once to set up your database and check Windows-specific requirements

echo "<h1>NovaShop E-Commerce - Windows Setup</h1>";

// Include Windows configuration
require_once 'config/windows_config.php';

echo "<h2>Windows System Check</h2>";

// Check if running on Windows
if (is_windows_system()) {
    echo "<p>✅ Running on Windows system</p>";
} else {
    echo "<p>⚠️ Not running on Windows system</p>";
}

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

// Check XAMPP installation
echo "<h2>XAMPP Check</h2>";
if (is_dir(WINDOWS_XAMPP_PATH)) {
    echo "<p>✅ XAMPP found at: " . WINDOWS_XAMPP_PATH . "</p>";
} else {
    echo "<p>❌ XAMPP not found at: " . WINDOWS_XAMPP_PATH . "</p>";
    echo "<p>Please install XAMPP or update the path in config/windows_config.php</p>";
}

// Check htdocs directory
if (is_dir(WINDOWS_HTDOCS_PATH)) {
    echo "<p>✅ htdocs directory found</p>";
} else {
    echo "<p>❌ htdocs directory not found</p>";
}

echo "<h2>Database Setup</h2>";

// Database configuration for Windows XAMPP
$host = WINDOWS_DB_HOST;
$username = 'root';
$password = '';
$database = 'asifechom';
$port = WINDOWS_DB_PORT;

try {
    // Windows-specific database connection
    $conn = new mysqli($host, $username, $password, '', $port);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
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
    echo "<p><strong>Troubleshooting:</strong></p>";
    echo "<ul>";
    echo "<li>Make sure XAMPP is running</li>";
    echo "<li>Start Apache and MySQL services in XAMPP Control Panel</li>";
    echo "<li>Check if MySQL is running on port 3306</li>";
    echo "<li>Verify database credentials in config/database.php</li>";
    echo "</ul>";
}

echo "<h2>File Permissions Check</h2>";

$directories = ['config', 'src/helpers', 'public/css'];
foreach ($directories as $dir) {
    $windows_dir = get_windows_path($dir);
    if (is_dir($windows_dir)) {
        echo "<p>✅ Directory '$dir' exists</p>";
        if (is_readable($windows_dir)) {
            echo "<p>✅ Directory '$dir' is readable</p>";
        } else {
            echo "<p>❌ Directory '$dir' is not readable</p>";
        }
    } else {
        echo "<p>❌ Directory '$dir' is missing</p>";
    }
}

$files = ['./config/database.php', 'src/helpers/session.php', 'src/helpers/header.php', 'src/helpers/footer.php', 'public/css/style.css'];
foreach ($files as $file) {
    $windows_file = get_windows_path($file);
    if (file_exists($windows_file)) {
        echo "<p>✅ File '$file' exists</p>";
        if (is_readable($windows_file)) {
            echo "<p>✅ File '$file' is readable</p>";
        } else {
            echo "<p>❌ File '$file' is not readable</p>";
        }
    } else {
        echo "<p>❌ File '$file' is missing</p>";
    }
}

echo "<h2>Apache Configuration Check</h2>";

// Check if .htaccess files exist
$htaccess_files = ['.htaccess', 'public/css/.htaccess'];
foreach ($htaccess_files as $htaccess) {
    $windows_htaccess = get_windows_path($htaccess);
    if (file_exists($windows_htaccess)) {
        echo "<p>✅ $htaccess exists</p>";
    } else {
        echo "<p>❌ $htaccess is missing</p>";
    }
}

// Check mod_rewrite
echo "<p><strong>Note:</strong> Make sure mod_rewrite is enabled in Apache</p>";
echo "<p>In XAMPP Control Panel → Apache → Config → httpd.conf, ensure this line is uncommented:</p>";
echo "<code>LoadModule rewrite_module modules/mod_rewrite.so</code>";

echo "<h2>Windows Setup Instructions</h2>";
echo "<ol>";
echo "<li>Make sure all system requirements are met (✅ above)</li>";
echo "<li>Start XAMPP Control Panel</li>";
echo "<li>Start Apache and MySQL services</li>";
echo "<li>If database tables are missing, import the database.sql file in phpMyAdmin</li>";
echo "<li>Configure database connection in config/database.php if needed</li>";
echo "<li>Navigate to http://localhost/E-Comm/ in your browser</li>";
echo "<li>Login with admin@novashop.com / password</li>";
echo "</ol>";

echo "<h2>Common Windows Issues & Solutions</h2>";
echo "<h3>1. Database Connection Issues</h3>";
echo "<ul>";
echo "<li>Make sure MySQL service is running in XAMPP</li>";
echo "<li>Check if port 3306 is not blocked by firewall</li>";
echo "<li>Verify database credentials</li>";
echo "</ul>";

echo "<h3>2. File Permission Issues</h3>";
echo "<ul>";
echo "<li>Run XAMPP as Administrator if needed</li>";
echo "<li>Check Windows Defender or antivirus blocking files</li>";
echo "<li>Ensure proper file permissions</li>";
echo "</ul>";

echo "<h3>3. URL Rewriting Issues</h3>";
echo "<ul>";
echo "<li>Enable mod_rewrite in Apache</li>";
echo "<li>Check .htaccess files exist</li>";
echo "<li>Restart Apache after configuration changes</li>";
echo "</ul>";

echo "<h2>Next Steps</h2>";
echo "<p><a href='index.php'>Go to Homepage</a></p>";
echo "<p><a href='login.php'>Go to Login</a></p>";
echo "<p><a href='register.php'>Go to Registration</a></p>";

echo "<p><strong>Note:</strong> Delete this windows_setup.php file after successful setup for security.</p>";
?>
