<?php
// Test file to verify the PATH_SEPARATOR fix and Windows configuration

echo "<h1>Windows Configuration Test - Fixed</h1>";

// Test 1: Check if PATH_SEPARATOR is properly defined
echo "<h2>Test 1: PATH_SEPARATOR Check</h2>";
echo "<p><strong>PHP Built-in PATH_SEPARATOR:</strong> " . PATH_SEPARATOR . "</p>";
echo "<p><strong>DIRECTORY_SEPARATOR:</strong> " . DIRECTORY_SEPARATOR . "</p>";

// Test 2: Include Windows configuration
echo "<h2>Test 2: Windows Configuration Include</h2>";
try {
    require_once 'config/windows_config.php';
    echo "<p>✅ Windows configuration loaded successfully</p>";
} catch (Exception $e) {
    echo "<p>❌ Error loading Windows configuration: " . $e->getMessage() . "</p>";
}

// Test 3: Test Windows detection
echo "<h2>Test 3: Windows System Detection</h2>";
if (function_exists('is_windows_system')) {
    if (is_windows_system()) {
        echo "<p>✅ Windows system detected</p>";
    } else {
        echo "<p>⚠️ Not a Windows system</p>";
    }
} else {
    echo "<p>❌ is_windows_system function not found</p>";
}

// Test 4: Test path conversion
echo "<h2>Test 4: Path Conversion Test</h2>";
if (function_exists('get_windows_path')) {
    $test_path = "config/database.php";
    $converted_path = get_windows_path($test_path);
    echo "<p><strong>Original path:</strong> $test_path</p>";
    echo "<p><strong>Converted path:</strong> $converted_path</p>";
    echo "<p><strong>File exists:</strong> " . (file_exists($converted_path) ? 'Yes' : 'No') . "</p>";
} else {
    echo "<p>❌ get_windows_path function not found</p>";
}

// Test 5: Test database connection
echo "<h2>Test 5: Database Connection Test</h2>";
try {
    require_once 'config/database.php';
    if (isset($conn) && !$conn->connect_error) {
        echo "<p>✅ Database connection successful</p>";
    } else {
        echo "<p>❌ Database connection failed</p>";
    }
} catch (Exception $e) {
    echo "<p>❌ Database error: " . $e->getMessage() . "</p>";
}

// Test 6: Test routing
echo "<h2>Test 6: Routing Test</h2>";
$test_routes = [
    'home' => 'index.php',
    'products' => 'products.php',
    'login' => 'login.php'
];

foreach ($test_routes as $route => $controller) {
    $controller_path = 'src/controllers/' . $controller;
    $windows_path = get_windows_path($controller_path);
    echo "<p><strong>$route:</strong> $controller_path -> $windows_path (Exists: " . (file_exists($windows_path) ? 'Yes' : 'No') . ")</p>";
}

echo "<h2>Test Results</h2>";
echo "<p>If all tests show ✅, the configuration is working correctly.</p>";
echo "<p><a href='index.php'>Test the main application</a></p>";
echo "<p><a href='windows_setup.php'>Run Windows Setup</a></p>";
?>
