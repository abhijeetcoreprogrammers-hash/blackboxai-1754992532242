<?php
/**
 * TPoint Tech Replica - Configuration File
 * Contains database connection and application settings
 */

// Error reporting for development (set to 0 for production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set timezone
date_default_timezone_set('Asia/Kolkata');

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'tpointtech_lms');
define('DB_CHARSET', 'utf8mb4');

// Application Configuration
define('BASE_URL', 'http://localhost:8000/');
define('SITE_NAME', 'TPoint Tech Replica');
define('SITE_DESCRIPTION', 'Free Online Tutorials - Learn Programming, Web Development, and Technology');

// File Upload Configuration
define('UPLOAD_PATH', __DIR__ . '/../../assets/uploads/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB

// Security Configuration
define('HASH_ALGO', PASSWORD_DEFAULT);
define('SESSION_LIFETIME', 3600); // 1 hour

// Pagination Configuration
define('TUTORIALS_PER_PAGE', 20);
define('COMMENTS_PER_PAGE', 10);

// Email Configuration (for future use)
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', '');
define('SMTP_PASSWORD', '');

try {
    // Create PDO connection with error handling
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . DB_CHARSET
    ];
    
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    
    // Set global PDO instance
    $GLOBALS['pdo'] = $pdo;
    
} catch (PDOException $e) {
    // Log error and show user-friendly message
    error_log("Database connection failed: " . $e->getMessage());
    die("Database connection failed. Please try again later.");
}

// Start session with security settings
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.cookie_secure', 0); // Set to 1 for HTTPS
    ini_set('session.use_strict_mode', 1);
    session_start();
}

// Helper function to sanitize output
function h($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Helper function to generate CSRF token
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Helper function to verify CSRF token
function verifyCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// Helper function to redirect
function redirect($url) {
    header("Location: " . BASE_URL . ltrim($url, '/'));
    exit();
}

// Helper function to get current URL
function getCurrentURL() {
    return BASE_URL . ltrim($_SERVER['REQUEST_URI'], '/');
}

// Helper function to format date
function formatDate($date, $format = 'M d, Y') {
    return date($format, strtotime($date));
}

// Helper function to truncate text
function truncateText($text, $length = 150, $suffix = '...') {
    if (strlen($text) <= $length) {
        return $text;
    }
    return substr($text, 0, $length) . $suffix;
}

// Helper function to generate slug
function generateSlug($text) {
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    $text = preg_replace('/[\s-]+/', '-', $text);
    return trim($text, '-');
}

// Helper function to get user IP
function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

// Helper function to log page view
function logPageView($pageType, $pageId = null, $userId = null) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("
            INSERT INTO page_views (page_type, page_id, user_id, ip_address, user_agent, referrer, session_id, viewed_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        $stmt->execute([
            $pageType,
            $pageId,
            $userId,
            getUserIP(),
            $_SERVER['HTTP_USER_AGENT'] ?? '',
            $_SERVER['HTTP_REFERER'] ?? '',
            session_id()
        ]);
    } catch (PDOException $e) {
        error_log("Failed to log page view: " . $e->getMessage());
    }
}

// Auto-loader function
function autoload($className) {
    $paths = [
        __DIR__ . '/../controllers/',
        __DIR__ . '/../models/',
        __DIR__ . '/../core/',
    ];
    
    foreach ($paths as $path) {
        $file = $path . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
}

// Register autoloader
spl_autoload_register('autoload');

// Application constants
define('APP_VERSION', '1.0.0');
define('APP_ENV', 'development'); // development, production

// Color scheme constants for the application
define('COLOR_ORANGE', '#FF6600');
define('COLOR_WHITE', '#FFFFFF');
define('COLOR_GREEN', '#28A745');
define('COLOR_BLACK', '#000000');
define('COLOR_LIGHT_GREEN', '#E8F5E8');
define('COLOR_LIGHT_ORANGE', '#FFF3E0');

?>
