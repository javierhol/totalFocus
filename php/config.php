<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'totalFocus';

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo('Base de datos creada correctamente.');
} else {
    echo 'Error al crear la base de datos: ' . $conn->error;
}

$conn->select_db($dbname);

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
    email VARCHAR(50) NOT NULL,
    details TEXT,
    img TEXT,
    modality VARCHAR(30) NOT NULL);

    CREATE TABLE IF NOT EXISTS contact (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    theme VARCHAR(30) NOT NULL,
    message TEXT NOT NULL);
";

if ($conn->multi_query($sqlCreateTables) === TRUE) {
    echo 'Tablas creadas correctamente.';
} else {
    echo 'Error al crear las tablas: ' . $conn->error;
}

$conn->close();

// Reabrir la conexión para las inserciones
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

$sqlInsertData = "
    INSERT INTO psycologists (name, email, details, img, modality) VALUES 
    ('Dr. Juan Pérez', 'JuanPerez@gmail.com', 'Psicólogo especializado en terapia de pareja', 'https://res.cloudinary.com/dkbvv7shv/image/upload/v1715644086/juan_anrn7k.jpg', 'presential'),
    ('Dra. María López', 'MariaLopez@gmail.com', 'Psicóloga especializada en terapia de familia', 'https://res.cloudinary.com/dkbvv7shv/image/upload/v1715644087/maria_vc6yoj.jpg', 'online'),
    ('Dr. Carlos Sánchez', 'CarlosSanchez@gmail.com', 'Psicólogo especializado en terapia de pareja', 'https://res.cloudinary.com/dkbvv7shv/image/upload/v1715644087/carlos_cvrmth.jpg', 'presential'),
    ('Dra. Ana Martínez', 'AnaMartinez@gmail.com', 'Psicóloga especializada en terapia de familia', 'https://res.cloudinary.com/dkbvv7shv/image/upload/v1715644087/ana_qacvb5.jpg', 'online'),
    ('Dr. José Rodríguez', 'JoseRodriguez@gmail.com', 'Psicólogo especializado en terapia de pareja', 'https://res.cloudinary.com/dkbvv7shv/image/upload/v1715644086/jose_m1n5zd.jpg', 'presential'),
    ('Dra. Laura Gómez', 'LauraGomez@gmail.com', 'Psicóloga especializada en terapia de familia', 'https://res.cloudinary.com/dkbvv7shv/image/upload/v1715644086/laura_snbckv.jpg', 'online');

    INSERT INTO juego (Palabras, Numdeletras) VALUES
    ('GUITARRA', 8),
    ('ELEFANTE', 8),
    ('TURQUESA', 8),
    ('MARIELA', 7),
    ('TECLADO', 7),
    ('INGLATERRA', 10);

    INSERT INTO podcast (titulo, autor) VALUES
    ('Ansiedad ¿Lo que pienso es real?', 'Equipo345'),
    ('El Secreto Para Superar La Ansiedad Y El Estrés', 'MARÍA ROS'),
    ('Cómo la ansiedad cambió mi vida', 'Cris Blanco'),
    ('Cómo calmar la ansiedad y los nervios', 'Marco Antonio Regil'),
    ('Dante Gebel #528 | Ansiedad', 'Dante Gebel'),
    ('¿CÓMO SUPERAR LA ANSIEDAD?', 'Equipo date cuenta');

    INSERT INTO libros (titulo, stock) VALUES
    ('Encuentra tu persona vitamina', 10),
    ('Cómo hacer que te pasen cosas buenas', 15),
    ('El fin de la ansiedad en niños y adolescentes', 20),
    ('Sin miedo', 8),
    ('Somos fuerza', 12),
    ('El cerebro de la gente feliz', 5);

    INSERT INTO productos (producto, stock) VALUES
    ('Taza Relaxifi', 30),
    ('Bolsa Relaxifi', 25),
    ('Té Toronjil', 40),
    ('Ashwagandha Calma', 10),
    ('Pasiflora y Valeriana', 15),
    ('Mascarilla Relaxifi', 20),
    ('Lavanda', 35),
    ('Té Calmante', 50),
    ('Toronjil con Manzanilla', 45);

    INSERT INTO articulos (nombre_articulo) VALUES
    ('Cómo manejar el estrés diario'),
    ('Estrategias para combatir la ansiedad'),
    ('Cómo superar el miedo al fracaso'),
    ('Técnicas de relajación para momentos de crisis'),
    ('Cómo mejorar la autoestima y la confianza en ti mismo'),
    ('Cómo establecer límites saludables para reducir el estrés');
";

if ($conn->multi_query($sqlInsertData) === TRUE) {
    echo 'Datos insertados correctamente.';
} else {
    echo 'Error al insertar los datos: ' . $conn->error;
}

$conn->close();
?>