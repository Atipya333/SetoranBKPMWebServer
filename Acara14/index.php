<?php

session_start();

// Load Config & Classes
require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/models/ProdiRepository.php';
require_once __DIR__ . '/models/MahasiswaRepository.php';
require_once __DIR__ . '/services/MahasiswaService.php';
require_once __DIR__ . '/controllers/MahasiswaController.php';

// Inisialisasi Database dan Repositories
$db = Database::getConnection();
$prodiRepo = new ProdiRepository($db);
$mahasiswaRepo = new MahasiswaRepository($db);

// Inject Repositories ke Service (Langkah 1 & 2)
$mahasiswaService = new MahasiswaService($mahasiswaRepo, $prodiRepo);

// Inject Service ke Controller
$controller = new MahasiswaController($mahasiswaService);

// Routing Sederhana
$page = $_GET['page'] ?? 'mahasiswa';

switch ($page) {
    case 'mahasiswa':
        $controller->index();
        break;
    case 'mahasiswa_create':
        $controller->create();
        break;
    case 'mahasiswa_store':
        $controller->store();
        break;
    case 'mahasiswa_edit':
        $controller->edit();
        break;
    case 'mahasiswa_update':
        $controller->update();
        break;
    case 'mahasiswa_delete':
        $controller->delete();
        break;
    default:
        $controller->index();
        break;
}