<?php
// Konfigurasi koneksi database
$host = 'localhost';      // Nama host (biasanya 'localhost')
$username = 'root';       // Username database (default XAMPP adalah 'root')
$password = '';           // Password database (default XAMPP kosong)
$database = 'geckomarket'; // Nama database Anda

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
