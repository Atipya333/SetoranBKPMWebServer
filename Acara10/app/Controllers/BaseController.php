<?php

class BaseController {
    // Method untuk menampilkan file view
    public function view($viewName, $data = []) {
        // Mengubah array key-value menjadi variabel terpisah
        extract($data);
        
        $filePath = "views/" . $viewName . ".php";
        if (file_exists($filePath)) {
            require_once $filePath;
        } else {
            echo "View file {$viewName} tidak ditemukan!";
        }
    }

    // Method untuk melakukan pengalihan halaman (redirect)
    public function redirect($url) {
        header("Location: " . $url);
        exit();
    }
}