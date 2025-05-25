<?php
// inc/db_connection.php
require_once __DIR__ . '/config.php';

function getDbConnection() {
    static $db = null;
    
    if ($db === null) {
        try {
            // Create database directory if it doesn't exist
            if (!file_exists(dirname(DB_PATH))) {
                mkdir(dirname(DB_PATH), 0755, true);
            }
            
            $db = new PDO('sqlite:' . DB_PATH);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $db->exec('PRAGMA foreign_keys = ON');
            
            // Initialize database tables if they don't exist
            initializeDatabase($db);
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            die("Database connection error. Please try again later.");
        }
    }
    
    return $db;
}

function initializeDatabase($db) {
    $db->exec('CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT UNIQUE NOT NULL,
        password_hash TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )');
    
    // Insert admin user if it doesn't exist
    $stmt = $db->prepare('SELECT COUNT(*) FROM users WHERE username = ?');
    $stmt->execute([ADMIN_USERNAME]);
    if ($stmt->fetchColumn() == 0) {
        $stmt = $db->prepare('INSERT INTO users (username, password_hash) VALUES (?, ?)');
        $stmt->execute([ADMIN_USERNAME, ADMIN_PASSWORD_HASH]);
    }
}

function isAdminLoggedIn() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}