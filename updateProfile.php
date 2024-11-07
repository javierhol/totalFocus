<?php
// Incluir el archivo de conexión a la base de datos
require_once 'connect.php';
session_start();

header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['user'])) {
        $userId = $_SESSION['user'];

        // $username = $_POST['username'];
        // $email = $_POST['email'];
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];

        $conn = getConnect();

        try {
            $query = "SELECT * FROM users WHERE id = ?";

            $statement = $conn->prepare($query);

            $statement->bind_param("i", $userId);

            $statement->execute();

            $result = $statement->get_result();

            if ($result->num_rows > 0) {
                $userData = $result->fetch_assoc();
                $password = $userData['pass'];

                if (password_verify($currentPassword, $password)) {
                    $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                    $query = "UPDATE users SET pass = ? WHERE id = ?";

                    $statement = $conn->prepare($query);

                    $statement->bind_param("si", $newPassword, $userId);

                    $statement->execute();

                    echo json_encode(['status' => 'success', 'message' => 'Contraseña actualizada correctamente']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'La contraseña actual no coincide']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'No se encontró ningún usuario con el ID proporcionado']);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Error de conexión: ' . $e->getMessage()]);
        } finally {
            $statement->close();
            $conn->close();
        }

    } else {
        echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
}
?>
