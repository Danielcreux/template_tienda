<?php
require_once __DIR__ . '/inc/motor.php';  // Fixed path
 // Fixed path
$data = [
    'page_title' => 'Fenix',
    'products' => [
        [
            'id' => 1,
            'name' => 'Zapatos Deportivos',
            'price' => 59.99,
            'image' => 'img/Zapatilla.webp'  // Fixed path
        ],
        [
            'id' => 2,
            'name' => 'Camiseta Casual',
            'price' => 19.99,
            'image' => 'img/camiseta.png'  // Fixed path
        ],
        [
            'id' => 3,
            'name' => 'Camiseta Casual',
            'price' => 19.99,
            'image' => 'img/camisagris.jpg'  // Fixed path
        ],
        [
            'id' => 4,
            'name' => 'Camiseta Casual',
            'price' => 19.99,
            'image' => 'img/zapatillablanca.jpg'  // Fixed path
        ]
    ],
    'promo_text' => 'Otoño 2025 - Hasta 50% de descuento'
];

echo render_template(__DIR__ . '/plantilla/storefront.html', $data);  // Fixed path
?>