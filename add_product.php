<?php
include 'database.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $price = floatval($_POST['price']);
    $description = $_POST['description'];
    $stock = intval($_POST['stock']);
    $species = $_POST['species'];
    $age = intval($_POST['age']);
    $user_id = intval($_POST['user_id']);
    $category_id = intval($_POST['category_id']);
    $image_url = $_POST['image_url'];

    $query = "INSERT INTO products (product_name, price, description, stock, species, age, user_id, category_id, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sdsisiiis", $product_name, $price, $description, $stock, $species, $age, $user_id, $category_id, $image_url);

    if ($stmt->execute()) {
        header("Location: index.php?message=Product added successfully");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Tambah Produk</h2>
        <form action="add_product.php" method="post">
            <div class="mb-3">
                <label for="product_name" class="form-label">Nama Produk</label>
                <input type="text" name="product_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" name="price" class="form-control" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stok</label>
                <input type="number" name="stock" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="species" class="form-label">Spesies</label>
                <input type="text" name="species" class="form-control">
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Usia</label>
                <input type="number" name="age" class="form-control">
            </div>
            <div class="mb-3">
                <label for="user_id" class="form-label">User ID</label>
                <input type="number" name="user_id" class="form-control">
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori ID</label>
                <input type="number" name="category_id" class="form-control">
            </div>
            <div class="mb-3">
                <label for="image_url" class="form-label">URL Gambar</label>
                <input type="url" name="image_url" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Tambah Produk</button>
        </form>
    </div>
</body>
</html>
