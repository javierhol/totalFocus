<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'totalFocus';

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

// Crear la base de datos si no existe
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
$conn->query($sql);
$conn->select_db($dbname);

// Comprobar si ya existen tablas
$tableCheck = $conn->query("SHOW TABLES LIKE 'products'");
if ($tableCheck->num_rows == 0) {
    // Si no existen tablas, crear las tablas y hacer las inserciones
    $sqlCreateTables = "
        CREATE TABLE IF NOT EXISTS users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        email VARCHAR(255),
        pass TEXT NOT NULL,
        img TEXT);

        CREATE TABLE IF NOT EXISTS products (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        price DECIMAL(10, 2) NOT NULL,
        stock INT(6) NOT NULL,
        img TEXT);

        CREATE TABLE IF NOT EXISTS contact (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL,
        theme VARCHAR(30) NOT NULL,
        message TEXT NOT NULL);
    ";

    if ($conn->multi_query($sqlCreateTables) === TRUE) {
        // Datos de productos
        $sqlInsertData = "INSERT INTO products (name, price, stock, img) VALUES
            ('Digital SLR', 10.50, 100, 'https://res.cloudinary.com/dkbvv7shv/image/upload/v1728664849/1_fw3utf.jpg'),
            ('Mirrorless', 20.50, 50, 'https://res.cloudinary.com/dkbvv7shv/image/upload/v1728664849/2_y8nsga.jpg'),
            ('Medium', 30.50, 25, 'https://res.cloudinary.com/dkbvv7shv/image/upload/v1728664849/3_qujgqd.jpg'),
            ('Action', 40.50, 10, 'https://res.cloudinary.com/dkbvv7shv/image/upload/v1728664849/4_gj05tf.jpg'),
            ('Film', 50.50, 5, 'https://res.cloudinary.com/dkbvv7shv/image/upload/v1728664850/5_gbtft1.jpg'),
            ('Instant', 60.50, 2, 'https://res.cloudinary.com/dkbvv7shv/image/upload/v1728664850/6_x1srez.jpg'),
            ('Rugged', 70.50, 1, 'https://res.cloudinary.com/dkbvv7shv/image/upload/v1728664849/7_rvectp.png'),
            ('Digital 2', 80.50, 0, 'https://res.cloudinary.com/dkbvv7shv/image/upload/v1728664849/8_e3us4e.jpg'),
            ('Cinema', 90.50, 0, 'https://res.cloudinary.com/dkbvv7shv/image/upload/v1728664849/9_lzewfx.jpg')";

        if ($conn->multi_query($sqlInsertData) === TRUE) {
            // Datos insertados correctamente
        }
    }
}

$conn->close();
?>
