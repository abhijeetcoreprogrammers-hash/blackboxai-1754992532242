<?php
/**
 * Base Controller Class
 * Provides common functionality for all controllers
 */

class Controller {
    protected $data = [];
    
    /**
     * Load a model
     */
    public function loadModel($model) {
        $modelFile = __DIR__ . '/../models/' . $model . '.php';
        if (file_exists($modelFile)) {
            require_once $modelFile;
            return new $model();
        } else {
            throw new Exception("Model {$model} not found");
        }
    }
    
    /**
     * Render a view with layout
     */
    public function render($view, $data = []) {
        // Merge controller data with passed data
        $this->data = array_merge($this->data, $data);
        
        // Extract data for use in views
        extract($this->data);
        
        // Start output buffering
        ob_start();
        
        // Include the view file
        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        if (file_exists($viewFile)) {
            include $viewFile;
        } else {
            throw new Exception("View {$view} not found");
        }
        
        // Get view content
        $content = ob_get_clean();
        
        // Include layout with content
        include __DIR__ . '/../views/layout/header.php';
        echo $content;
        include __DIR__ . '/../views/layout/footer.php';
    }
    
    /**
     * Render view without layout (for AJAX requests)
     */
    public function renderPartial($view, $data = []) {
        $this->data = array_merge($this->data, $data);
        extract($this->data);
        
        $viewFile = __DIR__ . '/../views/' . $view . '.php';
        if (file_exists($viewFile)) {
            include $viewFile;
        } else {
            throw new Exception("View {$view} not found");
        }
    }
    
    /**
     * Return JSON response
     */
    public function jsonResponse($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
    
    /**
     * Set page title
     */
    public function setTitle($title) {
        $this->data['pageTitle'] = $title . ' - ' . SITE_NAME;
    }
    
    /**
     * Set meta description
     */
    public function setMetaDescription($description) {
        $this->data['metaDescription'] = $description;
    }
    
    /**
     * Add CSS file
     */
    public function addCSS($cssFile) {
        if (!isset($this->data['cssFiles'])) {
            $this->data['cssFiles'] = [];
        }
        $this->data['cssFiles'][] = $cssFile;
    }
    
    /**
     * Add JavaScript file
     */
    public function addJS($jsFile) {
        if (!isset($this->data['jsFiles'])) {
            $this->data['jsFiles'] = [];
        }
        $this->data['jsFiles'][] = $jsFile;
    }
    
    /**
     * Check if user is logged in
     */
    protected function isLoggedIn() {
        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }
    
    /**
     * Get current user ID
     */
    protected function getCurrentUserId() {
        return $_SESSION['user_id'] ?? null;
    }
    
    /**
     * Require login
     */
    protected function requireLogin() {
        if (!$this->isLoggedIn()) {
            $_SESSION['redirect_after_login'] = getCurrentURL();
            redirect('auth/login');
        }
    }
    
    /**
     * Check if user has specific role
     */
    protected function hasRole($role) {
        return isset($_SESSION['user_role']) && $_SESSION['user_role'] === $role;
    }
    
    /**
     * Require specific role
     */
    protected function requireRole($role) {
        $this->requireLogin();
        if (!$this->hasRole($role)) {
            $this->render('errors/403', ['message' => 'Access denied']);
            exit();
        }
    }
    
    /**
     * Validate CSRF token
     */
    protected function validateCSRF() {
        $token = $_POST['csrf_token'] ?? $_GET['csrf_token'] ?? '';
        if (!verifyCSRFToken($token)) {
            $this->jsonResponse(['error' => 'Invalid CSRF token'], 403);
        }
    }
    
    /**
     * Set flash message
     */
    protected function setFlash($type, $message) {
        $_SESSION['flash'][$type] = $message;
    }
    
    /**
     * Get flash messages
     */
    protected function getFlash() {
        $flash = $_SESSION['flash'] ?? [];
        unset($_SESSION['flash']);
        return $flash;
    }
    
    /**
     * Validate input data
     */
    protected function validate($data, $rules) {
        $errors = [];
        
        foreach ($rules as $field => $rule) {
            $value = $data[$field] ?? '';
            $ruleArray = explode('|', $rule);
            
            foreach ($ruleArray as $singleRule) {
                if ($singleRule === 'required' && empty($value)) {
                    $errors[$field] = ucfirst($field) . ' is required';
                    break;
                }
                
                if (strpos($singleRule, 'min:') === 0 && strlen($value) < substr($singleRule, 4)) {
                    $errors[$field] = ucfirst($field) . ' must be at least ' . substr($singleRule, 4) . ' characters';
                    break;
                }
                
                if (strpos($singleRule, 'max:') === 0 && strlen($value) > substr($singleRule, 4)) {
                    $errors[$field] = ucfirst($field) . ' must not exceed ' . substr($singleRule, 4) . ' characters';
                    break;
                }
                
                if ($singleRule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $errors[$field] = ucfirst($field) . ' must be a valid email address';
                    break;
                }
                
                if ($singleRule === 'numeric' && !is_numeric($value)) {
                    $errors[$field] = ucfirst($field) . ' must be a number';
                    break;
                }
            }
        }
        
        return $errors;
    }
    
    /**
     * Sanitize input data
     */
    protected function sanitize($data) {
        if (is_array($data)) {
            return array_map([$this, 'sanitize'], $data);
        }
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
    
    /**
     * Handle file upload
     */
    protected function uploadFile($file, $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'], $maxSize = MAX_FILE_SIZE) {
        if (!isset($file['tmp_name']) || empty($file['tmp_name'])) {
            return ['error' => 'No file uploaded'];
        }
        
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['error' => 'File upload error'];
        }
        
        if ($file['size'] > $maxSize) {
            return ['error' => 'File size too large'];
        }
        
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, $allowedTypes)) {
            return ['error' => 'File type not allowed'];
        }
        
        $filename = uniqid() . '.' . $extension;
        $destination = UPLOAD_PATH . $filename;
        
        if (!is_dir(UPLOAD_PATH)) {
            mkdir(UPLOAD_PATH, 0755, true);
        }
        
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return ['success' => true, 'filename' => $filename];
        } else {
            return ['error' => 'Failed to move uploaded file'];
        }
    }
    
    /**
     * Log activity
     */
    protected function logActivity($action, $details = '') {
        global $pdo;
        try {
            $stmt = $pdo->prepare("
                INSERT INTO activity_logs (user_id, action, details, ip_address, user_agent, created_at) 
                VALUES (?, ?, ?, ?, ?, NOW())
            ");
            $stmt->execute([
                $this->getCurrentUserId(),
                $action,
                $details,
                getUserIP(),
                $_SERVER['HTTP_USER_AGENT'] ?? ''
            ]);
        } catch (PDOException $e) {
            error_log("Failed to log activity: " . $e->getMessage());
        }
    }
}
?>
