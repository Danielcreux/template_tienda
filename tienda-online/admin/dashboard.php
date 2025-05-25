<?php
// admin/dashboard.php
require_once __DIR__ . '/../inc/db_connection.php';
require_once __DIR__ . '/../inc/motor.php';

session_start();

if (!isAdminLoggedIn()) {
    header('Location: index.php');
    exit;
}

// Sample data for the dashboard
$data = [
    'page_title' => 'Admin Dashboard',
    'username' => $_SESSION['username'],
    'total_orders' => 42,
    'revenue' => '1,234.56',
    'products' => [
        [
            'id' => 1,
            'name' => 'Zapatos Deportivos',
            'price' => 59.99,
            'stock' => 10
        ],
        [
            'id' => 2,
            'name' => 'Camiseta Casual',
            'price' => 19.99,
            'stock' => 25
        ]
    ]
];

echo render_template(__DIR__ . '/../plantilla/admin_panel.html', $data);