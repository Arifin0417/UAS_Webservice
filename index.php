<?php
include 'database.php'; // Pastikan file ini mengatur koneksi ke database

// Query untuk mendapatkan semua produk
$query = "SELECT * FROM products";
$result = $conn->query($query);

// Periksa apakah query berhasil
if (!$result) {
    die("Error: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa;">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Manajemen Produk</h2>
        
        <!-- Form Tambah Produk -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Tambah Produk Baru</div>
            <div class="card-body">
                <form action="create_handler.php" method="post">
                    <div class="mb-3">
                        <label for="user_id" class="form-label">User ID</label>
                        <input type="number" name="user_id" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category ID</label>
                        <input type="number" name="category_id" class="form-control" required>
                    </div>
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
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stok</label>
                        <input type="number" name="stock" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="species" class="form-label">Spesies</label>
                        <input type="text" name="species" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">Umur (bulan)</label>
                        <input type="number" name="age" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="image_url" class="form-label">URL Gambar</label>
                        <input type="text" name="image_url" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">Tambah Produk</button>
                </form>
            </div>
        </div>

        <!-- Daftar Produk -->
        <div class="card">
            <div class="card-header bg-dark text-white">Daftar Produk</div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Stok</th>
                            <th>Spesies</th>
                            <th>Umur</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$no}</td>
                                <td>" . htmlspecialchars($row['product_name']) . "</td>
                                <td>Rp " . number_format($row['price'], 0, ',', '.') . "</td>
                                <td>" . htmlspecialchars($row['description']) . "</td>
                                <td>" . htmlspecialchars($row['stock']) . "</td>
                                <td>" . htmlspecialchars($row['species']) . "</td>
                                <td>" . htmlspecialchars($row['age']) . " bulan</td>
                                <td>
                                    <a href='update.php?id=" . htmlspecialchars($row['product_id']) . "' class='btn btn-warning btn-sm'>Update</a>
                                    <a href='delete.php?id=" . htmlspecialchars($row['product_id']) . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Yakin ingin menghapus produk ini?');\">Delete</a>
                                </td>
                            </tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
