<?php
// Mengatur header untuk respons JSON
header("Content-Type: application/json");

// Mengatur koneksi ke database
$servername = "localhost"; // atau host database Anda
$username = "root"; // ganti dengan username database Anda
$password = ""; // ganti dengan password database Anda
$dbname = "geckomarket"; // nama database

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Mengambil endpoint dari URL
$request_uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$endpoint = isset($request_uri[1]) ? $request_uri[1] : '';

// Menentukan jenis permintaan
$request_method = $_SERVER["REQUEST_METHOD"];

// Endpoint untuk products
if ($endpoint == 'products') {

    // Mengambil semua produk (GET)
    if ($request_method == 'GET') {
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $products = [];
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
            echo json_encode($products);
        } else {
            echo json_encode([]);
        }
    }

    // Menambahkan produk baru (POST)
    elseif ($request_method == 'POST') {
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['product_name'], $data['price'], $data['description'], $data['stock'], $data['species'], $data['age'], $data['user_id'], $data['category_id'])) {
            $product_name = $conn->real_escape_string($data['product_name']);
            $price = $conn->real_escape_string($data['price']);
            $description = $conn->real_escape_string($data['description']);
            $stock = $conn->real_escape_string($data['stock']);
            $species = $conn->real_escape_string($data['species']);
            $age = $conn->real_escape_string($data['age']);
            $user_id = $conn->real_escape_string($data['user_id']);
            $category_id = $conn->real_escape_string($data['category_id']);
            $image_url = isset($data['image_url']) ? $conn->real_escape_string($data['image_url']) : NULL;

            $sql = "INSERT INTO products (product_name, price, description, stock, species, age, user_id, category_id, image_url) 
                    VALUES ('$product_name', '$price', '$description', '$stock', '$species', '$age', '$user_id', '$category_id', '$image_url')";

            if ($conn->query($sql) === TRUE) {
                echo json_encode(["message" => "Product added successfully", "id" => $conn->insert_id]);
            } else {
                echo json_encode(["error" => "Error: " . $sql . " - " . $conn->error]);
            }
        } else {
            echo json_encode(["error" => "Invalid input"]);
        }
    }

    // Mengupdate produk (PUT)
    elseif ($request_method == 'PUT') {
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['product_id'], $data['product_name'], $data['price'], $data['description'], $data['stock'], $data['species'], $data['age'], $data['user_id'], $data['category_id'])) {
            $product_id = $conn->real_escape_string($data['product_id']);
            $product_name = $conn->real_escape_string($data['product_name']);
            $price = $conn->real_escape_string($data['price']);
            $description = $conn->real_escape_string($data['description']);
            $stock = $conn->real_escape_string($data['stock']);
            $species = $conn->real_escape_string($data['species']);
            $age = $conn->real_escape_string($data['age']);
            $user_id = $conn->real_escape_string($data['user_id']);
            $category_id = $conn->real_escape_string($data['category_id']);
            $image_url = isset($data['image_url']) ? $conn->real_escape_string($data['image_url']) : NULL;

            $sql = "UPDATE products SET product_name='$product_name', price='$price', description='$description', stock='$stock', 
                    species='$species', age='$age', user_id='$user_id', category_id='$category_id', image_url='$image_url' WHERE product_id='$product_id'";

            if ($conn->query($sql) === TRUE) {
                echo json_encode(["message" => "Product updated successfully"]);
            } else {
                echo json_encode(["error" => "Error: " . $sql . " - " . $conn->error]);
            }
        } else {
            echo json_encode(["error" => "Invalid input"]);
        }
    }

    // Menghapus produk (DELETE)
    elseif ($request_method == 'DELETE') {
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['product_id'])) {
            $product_id = $conn->real_escape_string($data['product_id']);

            $sql = "DELETE FROM products WHERE product_id='$product_id'";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(["message" => "Product deleted successfully"]);
            } else {
                echo json_encode(["error" => "Error: " . $sql . " - " . $conn->error]);
            }
        } else {
            echo json_encode(["error" => "Invalid input"]);
        }
    }

    // Jika metode tidak valid
    else {
        echo json_encode(["error" => "Invalid request method"]);
    }
}

// Jika endpoint tidak valid
else {
    echo json_encode(["error" => "Invalid endpoint"]);
}

// Menutup koneksi
$conn->close();
?>
