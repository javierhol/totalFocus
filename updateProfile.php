<?php
// Incluir el archivo de conexión a la base de datos
require_once 'connect.php';
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['user'])) {
        $userId = $_SESSION['user']['id'];

        $currentPassword = $_POST['currentPassword'] ?? null;
        $newPassword = $_POST['newPassword'] ?? null;
        $address = $_POST['address'] ?? null;
        $image = $_FILES['img'] ?? null;

        $conn = getConnect();

        try {
            $updateFields = [];
            $params = [];
            $types = "";
            $passwordUpdated = false; // Indicador para contraseña actualizada

            // Procesar contraseña nueva solo si se manda
            if (!empty($newPassword)) {
                if (!empty($currentPassword)) {
                    // Verificar contraseña actual
                    $query = "SELECT * FROM users WHERE id = ?";
                    $statement = $conn->prepare($query);
                    $statement->bind_param("i", $userId);
                    $statement->execute();
                    $result = $statement->get_result();

                    if ($result->num_rows > 0) {
                        $userData = $result->fetch_assoc();
                        $password = $userData['pass'];

                        // Verificar si la contraseña actual coincide
                        if (password_verify($currentPassword, $password)) {
                            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                            $updateFields[] = "pass = ?";
                            $params[] = $hashedPassword;
                            $types .= "s";
                            $passwordUpdated = true; // Marcamos que la contraseña se actualizó
                        } else {
                            echo json_encode(['status' => 'err', 'message' => 'La contraseña actual no coincide']);
                            exit;
                        }
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'No se encontró ningún usuario con el ID proporcionado']);
                        exit;
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Debe proporcionar la contraseña actual para cambiarla']);
                    exit;
                }
            }

            // Procesar dirección
            if (!empty($address)) {
                $updateFields[] = "address = ?";
                $params[] = $address;
                $types .= "s";
            }

            // Procesar imagen
            if (!empty($image) && $image['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';
                $fileName = uniqid() . "_" . basename($image['name']);
                $targetFilePath = $uploadDir . $fileName;

                if (move_uploaded_file($image['tmp_name'], $targetFilePath)) {
                    $imageUrl = $targetFilePath; // URL de la imagen
                    $updateFields[] = "img = ?";
                    $params[] = $imageUrl;
                    $types .= "s";
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Error al subir la imagen']);
                    exit;
                }
            }

            // Si hay campos para actualizar
            if (!empty($updateFields)) {
                // Crear consulta dinámica para actualizar los campos
                $query = "UPDATE users SET " . implode(", ", $updateFields) . " WHERE id = ?";
                $params[] = $userId;
                $types .= "i";

                $statement = $conn->prepare($query);
                $statement->bind_param($types, ...$params);
                $statement->execute();

                if ($passwordUpdated) {
                    echo json_encode(['status' => 'ok', 'message' => 'Contraseña actualizada correctamente']);
                } else {
                    echo json_encode(['status' => 'success', 'message' => 'Datos actualizados correctamente']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'No hay cambios que guardar']);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Error de conexión: ' . $e->getMessage()]);
        } finally {
            if (isset($statement) && $statement) {
                $statement->close();
            }
            $conn->close();
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Usuario no autenticado']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
}
?>
