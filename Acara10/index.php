<?php

require_once 'config/Database.php';
require_once 'app/Controllers/MahasiswaController.php';
require_once 'app/Repositories/MahasiswaRepository.php';

// Inisialisasi Koneksi Database dan Repository
$database = new Database();
$db = $database->getConnection();
$repository = new MahasiswaRepository($db);

// Inisialisasi Controller
$controller = new MahasiswaController($repository);

// Ambil aksi dari URL parameter (default: index)
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Routing Sederhana
switch ($action) {
    case 'index':
        $controller->index();
        break;
    case 'create':
        $controller->create();
        break;
    case 'store':
        $controller->store();
        break;
    case 'edit':
        if ($id) {
            $controller->edit($id);
        } else {
            $controller->redirect('index.php');
        }
        break;
    case 'update':
        if ($id) {
            $controller->update($id);
        } else {
            $controller->redirect('index.php');
        }
        break;
    case 'delete':
        if ($id) {
            $controller->delete($id);
        } else {
            $controller->redirect('index.php');
        }
        break;
    default:
        $controller->index();
        break;
}