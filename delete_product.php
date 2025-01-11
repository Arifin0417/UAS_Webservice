<?php
include 'database.php';

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    $query = "DELETE FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        header("Location: index.php?message=Produk berhasil dihapus");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "ID produk tidak ditemukan.";
}
?>
