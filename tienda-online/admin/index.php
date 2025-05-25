<?php
// admin/index.php
require_once __DIR__ . '/../inc/db_connection.php';
require_once __DIR__ . '/../inc/motor.php';

session_start();

// Check if user is already logged in
if (isAdminLoggedIn()) {
    header('Location: dashboard.php');
    exit;
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username === ADMIN_USERNAME && password_verify($password, ADMIN_PASSWORD_HASH)) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit;
    } else {
        $data = [
            'page_title' => 'Admin Login',
            'login_error' => 'Invalid username or password'
        ];
        echo render_template(__DIR__ . '/../plantilla/admin_login.html', $data);
        exit;
    }
}

// Show login form
$data = [
    'page_title' => 'Admin Login'
];
echo render_template(__DIR__ . '/../plantilla/admin_login.html', $data);