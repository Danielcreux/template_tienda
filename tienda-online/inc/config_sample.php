<?php
// inc/config.php
define('DB_PATH', __DIR__ . '/../db/database.db');
define('ADMIN_USERNAME', Username);
define('ADMIN_PASSWORD_HASH', password_hash( Password, PASSWORD_DEFAULT)); // Hashed password