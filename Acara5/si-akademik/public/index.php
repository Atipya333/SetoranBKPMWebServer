<?php

require_once __DIR__ . '/../routes/web.php';

// Ambil URI yang diakses
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Menghapus base path folder proyek agar URI menjadi bersih
$basePath = dirname($_SERVER['SCRIPT_NAME']);
if ($basePath !== '/' && strpos($requestUri, $basePath) === 0) {
    $requestUri = substr($requestUri, strlen($basePath));
}

if ($requestUri === '' || $requestUri === false) {
    $requestUri = '/';
}

// Jalankan pemetaan URL
handleRouting($requestUri, $routes);