<?php
// Test CSS file accessibility

echo "<h1>CSS File Test</h1>";

// Test 1: Check if CSS file exists
$css_path = 'public/css/style.css';
echo "<h2>Test 1: CSS File Existence</h2>";
if (file_exists($css_path)) {
    echo "<p>✅ CSS file exists at: $css_path</p>";
    echo "<p><strong>File size:</strong> " . filesize($css_path) . " bytes</p>";
    echo "<p><strong>Last modified:</strong> " . date('Y-m-d H:i:s', filemtime($css_path)) . "</p>";
} else {
    echo "<p>❌ CSS file not found at: $css_path</p>";
}

// Test 2: Check if CSS file is readable
echo "<h2>Test 2: CSS File Readability</h2>";
if (is_readable($css_path)) {
    echo "<p>✅ CSS file is readable</p>";
} else {
    echo "<p>❌ CSS file is not readable</p>";
}

// Test 3: Test CSS content
echo "<h2>Test 3: CSS Content Preview</h2>";
if (file_exists($css_path)) {
    $css_content = file_get_contents($css_path);
    $first_lines = implode('', array_slice(explode("\n", $css_content), 0, 5));
    echo "<p><strong>First 5 lines:</strong></p>";
    echo "<pre>" . htmlspecialchars($first_lines) . "</pre>";
}

// Test 4: Test URL accessibility
echo "<h2>Test 4: URL Accessibility</h2>";
$base_url = 'http://' . $_SERVER['HTTP_HOST'];
$css_url = $base_url . '/css/style.css';
echo "<p><strong>CSS URL:</strong> <a href='$css_url' target='_blank'>$css_url</a></p>";

// Test 5: Check .htaccess file
echo "<h2>Test 5: .htaccess Files</h2>";
$htaccess_files = ['.htaccess', 'public/css/.htaccess'];
foreach ($htaccess_files as $htaccess) {
    if (file_exists($htaccess)) {
        echo "<p>✅ $htaccess exists</p>";
    } else {
        echo "<p>❌ $htaccess missing</p>";
    }
}

// Test 6: Test static asset handling
echo "<h2>Test 6: Static Asset Handling</h2>";
$test_path = 'css/style.css';
$public_path = __DIR__ . '/public';
$file_path = $public_path . '/' . $test_path;

echo "<p><strong>Test path:</strong> $test_path</p>";
echo "<p><strong>Full file path:</strong> $file_path</p>";
echo "<p><strong>File exists:</strong> " . (file_exists($file_path) ? 'Yes' : 'No') . "</p>";

// Test 7: Check Apache mod_rewrite
echo "<h2>Test 7: Apache Configuration</h2>";
echo "<p><strong>Server Software:</strong> " . $_SERVER['SERVER_SOFTWARE'] . "</p>";
echo "<p><strong>Document Root:</strong> " . $_SERVER['DOCUMENT_ROOT'] . "</p>";
echo "<p><strong>Script Name:</strong> " . $_SERVER['SCRIPT_NAME'] . "</p>";

// Test 8: Direct CSS link test
echo "<h2>Test 8: Direct CSS Link Test</h2>";
echo "<p>Click the link below to test if CSS loads directly:</p>";
echo "<p><a href='/css/style.css' target='_blank'>Direct CSS Link</a></p>";

echo "<h2>Next Steps</h2>";
echo "<ul>";
echo "<li>If CSS file exists but URL doesn't work, check Apache mod_rewrite</li>";
echo "<li>If URL works but styling doesn't apply, check browser console for errors</li>";
echo "<li>Try accessing the CSS file directly to see if it loads</li>";
echo "</ul>";

echo "<p><a href='index.php'>Back to Homepage</a></p>";
?>
