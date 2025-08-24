<?php
// Muat autoloader Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Inisialisasi Dotenv untuk memuat variabel dari file .env

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Ambil variabel dari .env menggunakan $_ENV
$host = $_ENV['DB_HOST'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];
$database = $_ENV['DB_NAME'];

// Buat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {

    die("Koneksi ke database gagal."); 
}
?>