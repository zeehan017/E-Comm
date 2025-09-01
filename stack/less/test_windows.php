<?php
// Windows Configuration Test Script
// This script tests if the Windows configuration is working correctly

echo "<h1>Windows Configuration Test</h1>";

// Include Windows configuration
require_once 'config/windows_config.php';

echo "<h2>System Information</h2>";
echo "<p><strong>Operating System:</strong> " . PHP_OS . "</p>";
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
echo "<p><strong>Server Software:</strong> " . $_SERVER['SERVER_SOFTWARE'] . "</p>";

echo "<h2>Windows Detection</h2>";
if (is_windows_system()) {
    echo "<p>✅ Windows system detected</p>";
} else {
    echo "<p>⚠️ Not a Windows system</p>";
}

echo "<h2>Path Tests</h2>";

// Test path conversion
$test_path = "config/database.php";
$windows_path = get_windows_path($test_path);
echo "<p><strong>Original path:</strong> $test_path</p>";
echo "<p><strong>Windows path:</strong> $windows_path</p>";

// Test file existence
if (windows_file_exists($test_path)) {
    echo "<p>✅ File exists: $test_path</p>";
} else {
    echo "<p>❌ File not found: $test_path</p>";
}

echo "<h2>Database Connection Test</h2>";

try {
    // Include database configuration
    require_once 'config/database.php';
    
    // Test connection
    if ($conn && !$conn->connect_error) {
        echo "<p>✅ Database connection successful</p>";
        echo "<p><strong>Server info:</strong> " . $conn->server_info . "</p>";
        echo "<p><strong>Host info:</strong> " . $conn->host_info . "</p>";
    } else {
        echo "<p>❌ Database connection failed</p>";
    }
} catch (Exception $e) {
    echo "<p>❌ Database error: " . $e->getMessage() . "</p>";
}

echo "<h2>Directory Tests</h2>";

$directories = ['config', 'src', 'public', 'database'];
foreach ($directories as $dir) {
    if (is_dir($dir)) {
        echo "<p>✅ Directory exists: $dir</p>";
        if (is_readable($dir)) {
            echo "<p>✅ Directory readable: $dir</p>";
        } else {
            echo "<p>❌ Directory not readable: $dir</p>";
        }
    } else {
        echo "<p>❌ Directory missing: $dir</p>";
    }
}

echo "<h2>File Tests</h2>";

$files = [
    'config/database.php',
    'config/windows_config.php',
    'src/helpers/session.php',
    'public/css/style.css',
    '.htaccess'
];

foreach ($files as $file) {
    if (file_exists($file)) {
        echo "<p>✅ File exists: $file</p>";
        if (is_readable($file)) {
            echo "<p>✅ File readable: $file</p>";
        } else {
            echo "<p>❌ File not readable: $file</p>";
        }
    } else {
        echo "<p>❌ File missing: $file</p>";
    }
}

echo "<h2>XAMPP Path Tests</h2>";

if (is_dir(WINDOWS_XAMPP_PATH)) {
    echo "<p>✅ XAMPP found at: " . WINDOWS_XAMPP_PATH . "</p>";
} else {
    echo "<p>❌ XAMPP not found at: " . WINDOWS_XAMPP_PATH . "</p>";
}

if (is_dir(WINDOWS_HTDOCS_PATH)) {
    echo "<p>✅ htdocs found at: " . WINDOWS_HTDOCS_PATH . "</p>";
} else {
    echo "<p>❌ htdocs not found at: " . WINDOWS_HTDOCS_PATH . "</p>";
}

echo "<h2>Session Test</h2>";

$session_path = get_windows_session_path();
echo "<p><strong>Session path:</strong> $session_path</p>";

if (is_dir($session_path)) {
    echo "<p>✅ Session directory exists</p>";
    if (is_writable($session_path)) {
        echo "<p>✅ Session directory writable</p>";
    } else {
        echo "<p>❌ Session directory not writable</p>";
    }
} else {
    echo "<p>⚠️ Session directory doesn't exist (will be created)</p>";
}

echo "<h2>URL Test</h2>";

$app_url = get_windows_app_url();
echo "<p><strong>Application URL:</strong> $app_url</p>";

echo "<h2>Test Results Summary</h2>";

echo "<p><strong>Next Steps:</strong></p>";
echo "<ul>";
echo "<li>If all tests pass (✅), your Windows configuration is working correctly</li>";
echo "<li>If any tests fail (❌), check the WINDOWS_SETUP.md guide for solutions</li>";
echo "<li>Run the full setup: <a href='windows_setup.php'>Windows Setup Script</a></li>";
echo "<li>Test the application: <a href='index.php'>Go to Homepage</a></li>";
echo "</ul>";

echo "<p><strong>Note:</strong> Delete this test file after successful testing for security.</p>";
?>
