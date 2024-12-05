<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'totalFocus';

$conn = new mysqli($servername, $username, $password);

// Verificar la conexión
if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

// Crear la base de datos si no existe
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
$conn->query($sql);
$conn->select_db($dbname);

// Comprobar si la tabla 'products' existe
$tableCheck = $conn->query("SHOW TABLES LIKE 'products'");
if ($tableCheck->num_rows == 0) {
    // Crear las tablas si no existen
    $sqlCreateTables = "
        CREATE TABLE IF NOT EXISTS users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        email VARCHAR(255),
        pass TEXT NOT NULL,
        img TEXT,
        address VARCHAR(255));


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

        CREATE TABLE IF NOT EXISTS wishlist (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        product_id INT
        );

        CREATE TABLE IF NOT EXISTS cart (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        product_id INT,
        quantity INT
        );

        CREATE TABLE IF NOT EXISTS shopping (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        address VARCHAR(255),
        product_id INT,
        quantity INT,
        shipping_date TIMESTAMP
        );
    ";

    if ($conn->multi_query($sqlCreateTables) === TRUE) {
        // Procesar los resultados de la creación de tablas
        while ($conn->next_result()) {;} // Asegurarse de que todas las consultas se procesen
    } else {
        echo "Error al crear las tablas: " . $conn->error;
    }

    // Insertar los datos de productos
    $sqlInsertData = "INSERT INTO products (name, price, stock, img) VALUES
        ('Digital SLR', 10.50, 100, 'https://res.cloudinary.com/dkbvv7shv/image/upload/v1728664849/1_fw3utf.jpg'),
        ('Mirrorless', 20.50, 50, 'https://res.cloudinary.com/dkbvv7shv/image/upload/v1728664849/2_y8nsga.jpg'),
        ('Medium', 30.50, 25, 'https://res.cloudinary.com/dkbvv7shv/image/upload/v1728664849/3_qujgqd.jpg'),
        ('Action', 40.50, 10, 'https://res.cloudinary.com/dkbvv7shv/image/upload/v1728664849/4_gj05tf.jpg'),
        ('Film', 50.50, 15, 'https://res.cloudinary.com/dkbvv7shv/image/upload/v1728664850/5_gbtft1.jpg'),
        ('Instant', 60.50, 22, 'https://res.cloudinary.com/dkbvv7shv/image/upload/v1728664850/6_x1srez.jpg'),
        ('Rugged', 70.50, 17, 'https://res.cloudinary.com/dkbvv7shv/image/upload/v1728664849/7_rvectp.png'),
        ('Digital 2', 80.50, 14, 'https://res.cloudinary.com/dkbvv7shv/image/upload/v1728664849/8_e3us4e.jpg'),
        ('Cinema', 90.50, 18, 'https://res.cloudinary.com/dkbvv7shv/image/upload/v1728664849/9_lzewfx.jpg')";

    if ($conn->query($sqlInsertData) === TRUE) {
        return;
    } else {
        echo "Error al insertar los datos: " . $conn->error;
    }
}

$conn->close();
?>
