<?php
// Windows-specific configuration for NovaShop E-Commerce
// This file contains Windows-specific settings and paths

// Windows XAMPP default paths
define('WINDOWS_XAMPP_PATH', 'C:/xampp');
define('WINDOWS_HTDOCS_PATH', WINDOWS_XAMPP_PATH . '/htdocs');
define('WINDOWS_MYSQL_PATH', WINDOWS_XAMPP_PATH . '/mysql');

// Cross-platform path separator (PHP already provides PATH_SEPARATOR)
// Use DIRECTORY_SEPARATOR for consistency

// Windows-specific database settings
define('WINDOWS_DB_HOST', 'localhost');
define('WINDOWS_DB_PORT', 3306);
define('WINDOWS_DB_SOCKET', null); // Windows doesn't use socket files

// Windows file permissions (for reference)
define('WINDOWS_FILE_PERMISSIONS', 0644);
define('WINDOWS_DIR_PERMISSIONS', 0755);

// Windows-specific URL configuration
function get_windows_app_url() {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $path = dirname($_SERVER['SCRIPT_NAME']);
    return $protocol . '://' . $host . $path;
}

// Windows-specific file path functions
function get_windows_path($path) {
    return str_replace('/', DIRECTORY_SEPARATOR, $path);
}

function is_windows_system() {
    return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
}

// Windows-specific database connection
function get_windows_db_connection() {
    if (is_windows_system()) {
        return new mysqli(WINDOWS_DB_HOST, DB_USER, DB_PASS, DB_NAME, WINDOWS_DB_PORT);
    } else {
        // Linux fallback
        return new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, 3306);
    }
}

// Windows-specific error logging
function windows_error_log($message) {
    if (is_windows_system()) {
        error_log("[Windows] " . $message);
    }
}

// Windows-specific file operations
function windows_file_exists($path) {
    $windows_path = get_windows_path($path);
    return file_exists($windows_path);
}

function windows_is_readable($path) {
    $windows_path = get_windows_path($path);
    return is_readable($windows_path);
}

function windows_is_writable($path) {
    $windows_path = get_windows_path($path);
    return is_writable($windows_path);
}

// Windows-specific directory operations
function windows_mkdir($path, $mode = 0755, $recursive = true) {
    $windows_path = get_windows_path($path);
    return mkdir($windows_path, $mode, $recursive);
}

function windows_rmdir($path) {
    $windows_path = get_windows_path($path);
    return rmdir($windows_path);
}

// Windows-specific file operations
function windows_file_get_contents($path) {
    $windows_path = get_windows_path($path);
    return file_get_contents($windows_path);
}

function windows_file_put_contents($path, $data) {
    $windows_path = get_windows_path($path);
    return file_put_contents($windows_path, $data);
}

// Windows-specific include/require operations
function windows_include($path) {
    $windows_path = get_windows_path($path);
    return include($windows_path);
}

function windows_require($path) {
    $windows_path = get_windows_path($path);
    return require($windows_path);
}

function windows_require_once($path) {
    $windows_path = get_windows_path($path);
    return require_once($windows_path);
}

// Windows-specific session path
function get_windows_session_path() {
    if (is_windows_system()) {
        return sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'php_sessions';
    }
    return '/tmp';
}

// Initialize Windows-specific settings
if (is_windows_system()) {
    // Set Windows-specific session path
    $session_path = get_windows_session_path();
    if (!is_dir($session_path)) {
        windows_mkdir($session_path);
    }
    
    // Windows-specific error reporting
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('error_log', WINDOWS_XAMPP_PATH . '/php/logs/php_error.log');
    
    windows_error_log("Windows configuration loaded successfully");
}
?>
