<?php

$routes = [
    '/' => ['HomeController', 'index'],
    '/mahasiswa' => ['MahasiswaController', 'index'],
    '/mahasiswa/create' => ['MahasiswaController', 'create'],
];

function handleRouting($uri, $routes) {
    // 1. Cek rute statis
    if (array_key_exists($uri, $routes)) {
        [$controllerName, $methodName] = $routes[$uri];
        require_once __DIR__ . "/../app/controllers/{$controllerName}.php";
        $controller = new $controllerName();
        $controller->$methodName();
        return;
    }

    // 2. Cek rute dinamis dengan parameter (Tugas Mandiri: /mahasiswa/{id})
    if (preg_match('/^\/mahasiswa\/(\d+)$/', $uri, $matches)) {
        $id = $matches[1];
        require_once __DIR__ . "/../app/controllers/MahasiswaController.php";
        $controller = new MahasiswaController();
        $controller->show($id);
        return;
    }

    // 3. Tangani URL yang tidak terdaftar (Harus 404)
    http_response_code(404);
    echo "<h1>404 Not Found</h1><p>Halaman tidak ditemukan.</p>";
}