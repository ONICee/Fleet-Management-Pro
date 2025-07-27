<?php
/**
 * Helper functions for the Fleet Management System
 */

/**
 * Generate a URL with proper base path handling
 */
function url($path = '') {
    // Get the base path for subdirectory installations
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $basePath = dirname($scriptName);
    
    // Normalize base path
    if ($basePath === '/' || $basePath === '\\') {
        $basePath = '';
    }
    
    // Ensure path starts with /
    if (!empty($path) && $path[0] !== '/') {
        $path = '/' . $path;
    }
    
    return $basePath . $path;
}

/**
 * Generate an asset URL (for CSS, JS, images)
 */
function asset($path) {
    return url($path);
}

/**
 * Redirect to a URL
 */
function redirect($path) {
    header('Location: ' . url($path));
    exit;
}

/**
 * Get the current URL
 */
function currentUrl() {
    return $_SERVER['REQUEST_URI'];
}

/**
 * Check if current URL matches a pattern
 */
function isActiveRoute($pattern) {
    $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
    // Remove base path if in subdirectory
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $basePath = dirname($scriptName);
    
    if ($basePath !== '/' && strpos($currentPath, $basePath) === 0) {
        $currentPath = substr($currentPath, strlen($basePath));
    }
    
    if (empty($currentPath)) {
        $currentPath = '/';
    }
    
    return $currentPath === $pattern || strpos($currentPath, $pattern . '/') === 0;
}

/**
 * Escape HTML output
 */
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

/**
 * Format date for display
 */
function formatDate($date, $format = 'Y-m-d H:i:s') {
    if (empty($date)) return '';
    return date($format, strtotime($date));
}

/**
 * Format currency
 */
function formatCurrency($amount, $currency = 'NGN') {
    return $currency . ' ' . number_format($amount, 2);
}