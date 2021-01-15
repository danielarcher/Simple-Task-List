<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
date_default_timezone_set('Europe/Berlin');
$root = dirname(__DIR__);

return [
    'root' => $root,
    'temp' => $root. '/tmp',
    'public' => $root. '/public',
    'error' => [
        'display_error_details' => true,
        'log_errors' => true,
        'log_error_details' => true,
    ],
    'db' => [
        'driver' => 'mysql',
        'host' => 'mysql',
        'username' => 'root',
        'password' => 'root',
        'database' => 'app',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'flags' => [
            // Turn off persistent connections
            PDO::ATTR_PERSISTENT => false,
            // Enable exceptions
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // Emulate prepared statements
            PDO::ATTR_EMULATE_PREPARES => true,
            // Set default fetch mode to array
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ],
    ],
];