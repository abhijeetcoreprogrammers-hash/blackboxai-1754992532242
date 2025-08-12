<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= isset($pageTitle) ? h($pageTitle) : SITE_NAME ?></title>
    <meta name="description" content="<?= isset($metaDescription) ? h($metaDescription) : SITE_DESCRIPTION ?>" />
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css" />
    <?php if (isset($cssFiles) && is_array($cssFiles)): ?>
        <?php foreach ($cssFiles as $cssFile): ?>
            <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/<?= h($cssFile) ?>" />
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
<header>
    <div class="container">
        <div class="logo">
            <a href="<?= BASE_URL ?>">
                <img src="https://tpointtech-images.s3.eu-north-1.amazonaws.com/static/images/dark-logo.svg" alt="TPoint Tech Logo" />
            </a>
        </div>
        <nav>
            <ul>
                <li><a href="<?= BASE_URL ?>">Home</a></li>
                <li><a href="<?= BASE_URL ?>?controller=Home&action=index">Tutorials</a></li>
                <li><a href="#">Online Compiler</a></li>
                <li><a href="#">Interview Questions</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </div>
</header>
<main>
<?php
// Display flash messages if any
if (isset($_SESSION['flash'])) {
    foreach ($_SESSION['flash'] as $type => $message) {
        echo '<div class="flash-message ' . h($type) . '">' . h($message) . '</div>';
    }
    unset($_SESSION['flash']);
}
?>
