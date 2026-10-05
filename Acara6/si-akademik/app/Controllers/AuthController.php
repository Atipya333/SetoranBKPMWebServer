<?php
require_once __DIR__ . '/../Helpers/Session.php';

class AuthController {
    public function loginForm() {
        $flash = Session::getFlash('logout') ?? Session::getFlash('error');
        require_once __DIR__ . '/../Views/auth/login.php';
    }

    public function login() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($username === 'admin' && $password === 'admin123') {
            $_SESSION['user_logged_in'] = true;

            Session::setFlash('success', 'Selamat datang, Admin');
            // Gunakan BASE_URL untuk redirect ke dashboard
            header('Location: ' . BASE_URL . '/dashboard');
            exit();
        } else {
            Session::setFlash('error', 'Username atau password salah');
            // Gunakan BASE_URL untuk redirect kembali ke login
            header('Location: ' . BASE_URL . '/login');
            exit();
        }
    }

    public function logout() {
        unset($_SESSION['user_logged_in']);

        Session::setFlash('logout', 'Anda telah logout');
        // Gunakan BASE_URL untuk redirect ke login
        header('Location: ' . BASE_URL . '/login');
        exit();
    }
}