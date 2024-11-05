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
            // Validar la contraseña actual
            $passwordQuery = 'SELECT username, email, pass FROM users WHERE id = ?';
            $passwordStmt = $conn->prepare($passwordQuery);
            if (!$passwordStmt) {
                throw new Exception('Error al preparar la consulta: ' . $conn->error);
            }
            $passwordStmt->bind_param('i', $userId);
            $passwordStmt->execute();
            $passwordResult = $passwordStmt->get_result();
            $userData = $passwordResult->fetch_assoc();

            // Verificar si la contraseña es correcta
            if (password_verify($currentPassword, $userData['pass'])) {

                // Verificar si el username y el email son diferentes a los actuales
                if ($username === $userData['username'] && $email === $userData['email'] && empty($newPassword)) {
                    echo json_encode(['status' => 'error', 'message' => 'No se realizaron cambios porque los datos no han cambiado']);
                    return;
                }

                // Actualizar la nueva contraseña si se proporciona
                if (!empty($newPassword)) {
                    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                    $updatePasswordQuery = 'UPDATE users SET pass = ? WHERE id = ?';
                    $updatePasswordStmt = $conn->prepare($updatePasswordQuery);
                    if (!$updatePasswordStmt) {
                        throw new Exception('Error al preparar la consulta: ' . $conn->error);
                    }
                    $updatePasswordStmt->bind_param('si', $newPasswordHash, $userId);
                    $updatePasswordStmt->execute();
                    $updatePasswordStmt->close();
                }

                // Actualizar otros datos del usuario (username, email)
                if ($username !== $userData['username'] || $email !== $userData['email']) {
                    $query = 'UPDATE users SET username = ?, email = ? WHERE id = ?';
                    $stmt = $conn->prepare($query);
                    if (!$stmt) {
                        throw new Exception('Error al preparar la consulta: ' . $conn->error);
                    }
                    $stmt->bind_param('ssi', $username, $email, $userId);
                    $stmt->execute();
                }

                // Verificar si la consulta de actualización afectó alguna fila
                if ($stmt->affected_rows > 0 || !empty($newPassword)) {
                    echo json_encode(['status' => 'success', 'message' => 'Datos actualizados correctamente']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'No se realizaron cambios']);
                }

                $stmt->close();
                $conn->close();
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Contraseña actual incorrecta']);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
}
?>
