<?php
/**
 * TPoint Tech Replica - Complete Installation Script
 * Handles database creation, configuration, and sample data insertion
 */

set_time_limit(0);
ini_set('max_execution_time', 0);
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Installation status
$installationComplete = false;
$errors = [];
$messages = [];

// Check if installation is already complete
if (file_exists(__DIR__ . '/../.installed')) {
    $installationComplete = true;
}

// Handle form submission
if ($_POST && !$installationComplete) {
    $dbHost = $_POST['db_host'] ?? 'localhost';
    $dbUser = $_POST['db_user'] ?? 'root';
    $dbPass = $_POST['db_pass'] ?? '';
    $dbName = $_POST['db_name'] ?? 'tpointtech_lms';
    $baseUrl = $_POST['base_url'] ?? 'http://localhost:8000/';
    
    try {
        // Test database connection
        $dsn = "mysql:host={$dbHost};charset=utf8mb4";
        $pdo = new PDO($dsn, $dbUser, $dbPass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        
        $messages[] = "✓ Database connection successful";
        
        // Create database if it doesn't exist
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$dbName}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        $pdo->exec("USE `{$dbName}`");
        $messages[] = "✓ Database '{$dbName}' created/selected";
        
        // Execute schema SQL
        $schemaFile = __DIR__ . '/../database/schema.sql';
        if (file_exists($schemaFile)) {
            $sql = file_get_contents($schemaFile);
            // Remove USE database statement from schema as we already selected it
            $sql = preg_replace('/USE\s+[^;]+;/i', '', $sql);
            $pdo->exec($sql);
            $messages[] = "✓ Database schema created successfully";
        } else {
            throw new Exception("Schema file not found");
        }
        
        // Execute sample data SQL
        $dataFile = __DIR__ . '/../database/sample_data.sql';
        if (file_exists($dataFile)) {
            $sql = file_get_contents($dataFile);
            // Remove USE database statement from data file
            $sql = preg_replace('/USE\s+[^;]+;/i', '', $sql);
            $pdo->exec($sql);
            $messages[] = "✓ Sample data inserted successfully";
        } else {
            throw new Exception("Sample data file not found");
        }
        
        // Update configuration file
        $configFile = __DIR__ . '/../app/config/config.php';
        $configContent = file_get_contents($configFile);
        
        // Replace database configuration
        $configContent = preg_replace("/define\('DB_HOST',\s*'[^']*'\);/", "define('DB_HOST', '{$dbHost}');", $configContent);
        $configContent = preg_replace("/define\('DB_USER',\s*'[^']*'\);/", "define('DB_USER', '{$dbUser}');", $configContent);
        $configContent = preg_replace("/define\('DB_PASS',\s*'[^']*'\);/", "define('DB_PASS', '{$dbPass}');", $configContent);
        $configContent = preg_replace("/define\('DB_NAME',\s*'[^']*'\);/", "define('DB_NAME', '{$dbName}');", $configContent);
        $configContent = preg_replace("/define\('BASE_URL',\s*'[^']*'\);/", "define('BASE_URL', '{$baseUrl}');", $configContent);
        
        file_put_contents($configFile, $configContent);
        $messages[] = "✓ Configuration file updated";
        
        // Create installation marker
        file_put_contents(__DIR__ . '/../.installed', date('Y-m-d H:i:s'));
        $messages[] = "✓ Installation marker created";
        
        $installationComplete = true;
        $messages[] = "🎉 Installation completed successfully!";
        
    } catch (Exception $e) {
        $errors[] = "Installation failed: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TPoint Tech Replica - Installation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #FF6600;
            text-align: center;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"], input[type="password"], input[type="url"] {
            width: 100%;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="text"]:focus, input[type="password"]:focus, input[type="url"]:focus {
            border-color: #FF6600;
            outline: none;
        }
        .btn {
            background-color: #FF6600;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }
        .btn:hover {
            background-color: #e55a00;
        }
        .btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
        .messages {
            margin: 20px 0;
        }
        .message {
            padding: 10px;
            margin: 5px 0;
            border-radius: 4px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .requirements {
            background-color: #e2e3e5;
            padding: 20px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .requirements h3 {
            color: #495057;
            margin-top: 0;
        }
        .requirements ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        .complete {
            text-align: center;
            padding: 40px 20px;
        }
        .complete h2 {
            color: #28A745;
            margin-bottom: 20px;
        }
        .complete .btn {
            background-color: #28A745;
            margin: 10px;
            width: auto;
            display: inline-block;
        }
        .complete .btn:hover {
            background-color: #218838;
        }
        .warning {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 TPoint Tech Replica Installation</h1>
        
        <?php if ($installationComplete): ?>
            <div class="complete">
                <h2>✅ Installation Complete!</h2>
                <p>Your TPoint Tech Replica has been successfully installed and configured.</p>
                
                <div class="messages">
                    <?php foreach ($messages as $message): ?>
                        <div class="message success"><?= htmlspecialchars($message) ?></div>
                    <?php endforeach; ?>
                </div>
                
                <div class="warning">
                    <strong>⚠️ Security Notice:</strong> Please delete or secure this installation.php file immediately for security reasons.
                </div>
                
                <a href="../" class="btn">🏠 Go to Homepage</a>
                <a href="../?controller=Home&action=index" class="btn">📚 View Tutorials</a>
            </div>
        <?php else: ?>
            <div class="requirements">
                <h3>📋 System Requirements</h3>
                <ul>
                    <li>PHP 7.4 or higher ✓</li>
                    <li>MySQL 5.7 or higher ✓</li>
                    <li>PDO MySQL extension ✓</li>
                    <li>Write permissions on config directory ✓</li>
                </ul>
            </div>
            
            <?php if (!empty($errors)): ?>
                <div class="messages">
                    <?php foreach ($errors as $error): ?>
                        <div class="message error"><?= htmlspecialchars($error) ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($messages)): ?>
                <div class="messages">
                    <?php foreach ($messages as $message): ?>
                        <div class="message success"><?= htmlspecialchars($message) ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="db_host">Database Host:</label>
                    <input type="text" id="db_host" name="db_host" value="<?= htmlspecialchars($_POST['db_host'] ?? 'localhost') ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="db_user">Database Username:</label>
                    <input type="text" id="db_user" name="db_user" value="<?= htmlspecialchars($_POST['db_user'] ?? 'root') ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="db_pass">Database Password:</label>
                    <input type="password" id="db_pass" name="db_pass" value="<?= htmlspecialchars($_POST['db_pass'] ?? '') ?>">
                </div>
                
                <div class="form-group">
                    <label for="db_name">Database Name:</label>
                    <input type="text" id="db_name" name="db_name" value="<?= htmlspecialchars($_POST['db_name'] ?? 'tpointtech_lms') ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="base_url">Base URL:</label>
                    <input type="url" id="base_url" name="base_url" value="<?= htmlspecialchars($_POST['base_url'] ?? 'http://localhost:8000/') ?>" required>
                </div>
                
                <button type="submit" class="btn">🚀 Install TPoint Tech Replica</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
