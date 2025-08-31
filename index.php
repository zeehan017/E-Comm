<?php
// Root entry point for the application
// This file handles routing and includes the appropriate controller

// Define base paths
define('BASE_PATH', __DIR__);
define('SRC_PATH', BASE_PATH . '/src');
define('CONFIG_PATH', BASE_PATH . '/config');
define('PUBLIC_PATH', BASE_PATH . '/public');


// Include configuration and helpers
require_once CONFIG_PATH . '/database.php';
require_once SRC_PATH . '/helpers/session.php';

// Simple routing
$request_uri = $_SERVER['REQUEST_URI'];
$path = parse_url($request_uri, PHP_URL_PATH);
$path = trim($path, '/');

// Remove the project folder name from path if present
$project_folder = basename(__DIR__);
if (strpos($path, $project_folder) === 0) {
    $path = substr($path, strlen($project_folder));
}
$path = trim($path, '/');

// Handle static assets
if (preg_match('/\.(css|js|png|jpg|jpeg|gif|ico|svg)$/', $path)) {
    $file_path = PUBLIC_PATH . '/' . $path;
    if (file_exists($file_path)) {
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $content_types = [
            'css' => 'text/css',
            'js' => 'application/javascript',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'ico' => 'image/x-icon',
            'svg' => 'image/svg+xml'
        ];
        
        if (isset($content_types[$extension])) {
            header('Content-Type: ' . $content_types[$extension]);
        }
        readfile($file_path);
        exit();
    }
}

// Default route
if (empty($path)) {
    $path = 'home';
}

// Route mapping
$routes = [
    'home' => 'index.php',
    'index' => 'index.php',
    'products' => 'products.php',
    'cart' => 'cart.php',
    'wishlist' => 'wishlist.php',
    'profile' => 'profile.php',
    'login' => 'login.php',
    'register' => 'register.php',
    'logout' => 'logout.php',
    'payment' => 'payment.php',
    'admin' => 'admin.php',
    'order-confirmation' => 'order_confirmation.php'
];

// Check if route exists
if (isset($routes[$path])) {
    $controller_file = SRC_PATH . '/controllers/' . $routes[$path];
    if (file_exists($controller_file)) {
        require_once $controller_file;
    } else {
        http_response_code(404);
        echo "Page not found: $path";
    }
} else {
    http_response_code(404);
    echo "Page not found: $path";
}
?>
