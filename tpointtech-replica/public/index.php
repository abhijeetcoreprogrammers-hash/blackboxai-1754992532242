<?php
/**
 * Front Controller for TPoint Tech Replica
 * Handles all incoming requests and routes them to appropriate controllers
 */

// Include configuration
require_once __DIR__ . '/../app/config/config.php';

// Log page view for analytics
logPageView('home', null, $_SESSION['user_id'] ?? null);

try {
    // Parse URL parameters
    $controller = $_GET['controller'] ?? 'Home';
    $action = $_GET['action'] ?? 'index';
    
    // Sanitize controller and action names
    $controller = preg_replace('/[^a-zA-Z0-9]/', '', $controller);
    $action = preg_replace('/[^a-zA-Z0-9]/', '', $action);
    
    // Build controller class name
    $controllerClass = $controller . 'Controller';
    
    // Check if controller class exists
    if (!class_exists($controllerClass)) {
        throw new Exception("Controller {$controllerClass} not found");
    }
    
    // Instantiate controller
    $controllerInstance = new $controllerClass();
    
    // Check if action method exists
    if (!method_exists($controllerInstance, $action)) {
        throw new Exception("Action {$action} not found in {$controllerClass}");
    }
    
    // Call the action
    $controllerInstance->$action();
    
} catch (Exception $e) {
    // Log error
    error_log("Routing error: " . $e->getMessage());
    
    // Show 404 error page
    http_response_code(404);
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Page Not Found - " . SITE_NAME . "</title>
        <style>
            body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
            h1 { color: " . COLOR_ORANGE . "; }
            p { color: " . COLOR_BLACK . "; }
            a { color: " . COLOR_GREEN . "; text-decoration: none; }
        </style>
    </head>
    <body>
        <h1>404 - Page Not Found</h1>
        <p>The page you are looking for could not be found.</p>
        <p><a href='" . BASE_URL . "'>Go to Homepage</a></p>
    </body>
    </html>";
}
?>
