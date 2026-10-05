<?php
require_once __DIR__ . '/../app/Helpers/Session.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Middlewares/AuthMiddleware.php';

// Definisikan BASE_URL secara otomatis sesuai path folder
$basePath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
define('BASE_URL', $basePath);

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (strpos($requestUri, BASE_URL) === 0) {
    $requestUri = substr($requestUri, strlen(BASE_URL));
}

$method = $_SERVER['REQUEST_METHOD'];

// Routing
if ($requestUri === '' || $requestUri === '/') {
    header('Location: ' . BASE_URL . '/login');
    exit();
} elseif ($requestUri === '/login' && $method === 'GET') {
    (new AuthController())->loginForm();
} elseif ($requestUri === '/login' && $method === 'POST') {
    (new AuthController())->login();
} elseif ($requestUri === '/logout') {
    (new AuthController())->logout();
} elseif ($requestUri === '/dashboard' || $requestUri === '/mahasiswa') {
    AuthMiddleware::handle();
    require_once __DIR__ . '/../app/Views/dashboard/index.php';
} else {
    http_response_code(404);
    echo "404 Not Found";
}