<?php
include 'database.php'; // Pastikan file ini mengatur koneksi ke database

// Periksa apakah request adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : null;
    $category_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : null;
    $product_name = isset($_POST['product_name']) ? $conn->real_escape_string($_POST['product_name']) : null;
    $price = isset($_POST['price']) ? floatval($_POST['price']) : null;
    $description = isset($_POST['description']) ? $conn->real_escape_string($_POST['description']) : null;
    $stock = isset($_POST['stock']) ? intval($_POST['stock']) : 0;
    $species = isset($_POST['species']) ? $conn->real_escape_string($_POST['species']) : null;
    $age = isset($_POST['age']) ? intval($_POST['age']) : null;
    $image_url = isset($_POST['image_url']) ? $conn->real_escape_string($_POST['image_url']) : null;

    // Validasi input
    if (!$product_name || !$price || !$user_id || !$category_id) {
        echo json_encode(["error" => "Input tidak lengkap"]);
        exit;
    }

    // Query untuk menyimpan data ke database
    $query = "INSERT INTO products (user_id, category_id, product_name, price, description, stock, species, age, image_url)
              VALUES ('$user_id', '$category_id', '$product_name', '$price', '$description', '$stock', '$species', '$age', '$image_url')";

    if ($conn->query($query)) {
        // Redirect kembali ke halaman utama atau tampilkan pesan sukses
        header("Location: index.php");
        exit;
    } else {
        echo json_encode(["error" => "Gagal menyimpan data: " . $conn->error]);
    }
} else {
    echo json_encode(["error" => "Invalid endpoint"]);
}
?>
