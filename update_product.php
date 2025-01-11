<?php
include 'database.php'; // Koneksi ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = intval($_POST['product_id']);
    $product_name = $_POST['product_name'];
    $price = floatval($_POST['price']);
    $description = $_POST['description'];
    $stock = intval($_POST['stock']);
    $species = $_POST['species'];
    $age = intval($_POST['age']);
    $user_id = intval($_POST['user_id']);
    $category_id = intval($_POST['category_id']);
    $image_url = $_POST['image_url'];

    $query = "UPDATE products SET product_name = ?, price = ?, description = ?, stock = ?, species = ?, age = ?, user_id = ?, category_id = ?, image_url = ? WHERE product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sdsiisiiii", $product_name, $price, $description, $stock, $species, $age, $user_id, $category_id, $image_url, $product_id);

    if ($stmt->execute()) {
        header("Location: index.php?message=Product updated successfully");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
} else if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    $query = "SELECT * FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
} else {
    echo "Invalid request";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Update Produk</h2>
        <form action="update_product.php" method="post">
            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
            <div class="mb-3">
                <label for="product_name" class="form-label">Nama Produk</label>
                <input type="text" name="product_name" class="form-control" value="<?= $product['product_name'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" name="price" class="form-control" step="0.01" value="<?= $product['price'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control" rows="3" required><?= $product['description'] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label">Stok</label>
                <input type="number" name="stock" class="form-control" value="<?= $product['stock'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="species" class="form-label">Spesies</label>
                <input type="text" name="species" class="form-control" value="<?= $product['species'] ?>">
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Usia</label>
                <input type="number" name="age" class="form-control" value="<?= $product['age'] ?>">
            </div>
            <div class="mb-3">
                <label for="user_id" class="form-label">User ID</label>
                <input type="number" name="user_id" class="form-control" value="<?= $product['user_id'] ?>">
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori ID</label>
                <input type="number" name="category_id" class="form-control" value="<?= $product['category_id'] ?>">
            </div>
            <div class="mb-3">
                <label for="image_url" class="form-label">URL Gambar</label>
                <input type="url" name="image_url" class="form-control" value="<?= $product['image_url'] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Produk</button>
        </form>
    </div>
</body>
</html>